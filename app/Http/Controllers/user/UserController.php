<?php

namespace App\Http\Controllers\user;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Response\ResponseApi;
use App\Mail\SendVerifiMail;
use App\Mail\SendResetMailPassword;
use App\Mail\SendVerificationMail;

class UserController extends Controller
{

    public function index()
    {
        $responseApi = new ResponseApi();
        try {
            // Usa `with` para cargar las relaciones necesarias
            $listaUser = User::with('roles_fk')->get();
            if ($listaUser->isEmpty()) {
                return $responseApi->error("No hay usuarios encontrados");
            }
            return $responseApi->success("Lista de usuarios", 200, $listaUser, "");
        } catch (Exception $e) {
            return $responseApi->error("Error: " . $e->getMessage());
        }
    }


    public function register(Request $request)
    {
        $responseApi = new ResponseApi();
        try {
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required|max:50',
                'apellido' => 'required|max:100|string',
                'telefono' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'dni' => 'required|max:8|string',
                'direccion' => 'required',
                'sexo' => 'required|in:m,f',
                'fecha_nacimiento' => 'max:20',
                'extencion' => 'max:20',  // nuemro de telefono del area
                'tipo_fiscal' => 'required|max:50|',
                'activo' => 'required',
                'fecha_ingreso' => 'nullable|date',
                'email_verified_at' => 'nullable|date',
                'password' => 'required|confirmed|min:5',
                'estado' => 'required|boolean',
                'fiscalia_fk' => 'nullable',
                'roles_fk' => 'nullable'
                //'session_fk' => 'required|exists:Sesion,id',
            ]);

            if ($validacion->fails()) {
                return $responseApi->error("Error en la validación", 422, $validacion->errors());
            }

            // Creación del usuario
            $user = User::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'dni' => $request->dni,
                'direccion' => $request->direccion,
                'sexo' => $request->sexo,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'extencion' => $request->extencion,
                'tipo_fiscal' => $request->tipo_fiscal,
                'activo' => $request->activo,
                'fecha_ingreso' => $request->fecha_ingreso,
                'password' => Hash::make($request->password),
                'estado' => $request->estado,
                'fiscalia_fk' => $request->fiscalia_fk,
                'roles_fk' => $request->roles_fk
            ]);

            if (!$user) {
                return $responseApi->error("Error en la creación del usuario", 422);
            }

            //$this->sendVerificationEmail($user);

            return $responseApi->success("Usuario creado con éxito. Tiene que confirmar el correo electrónico para iniciar sesión", 200, $user);
        } catch (Exception $e) {
            return $responseApi->error("Error: " . $e->getMessage());
        }
    }




    public function login(Request $request)
    {

        try {
            $responseApi = new ResponseApi();

            $validacion = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:5'
            ]);

            if ($validacion->fails()) {
                return $responseApi->error("Error en la validacion", 422, $validacion->errors());
            }

            //$user = User::where('email', $request->email)->first();

            $user = User::where('email', $request->email)
                ->with('fiscalia_fk', 'roles_fk') // Carga las relaciones
                ->first();


            if (!$user) {
                return $responseApi->error('Error: Correo incorrecto', 401, $validacion->errors());
            } else if (!Hash::check($request->password, $user->password)) {
                return $responseApi->error('Error: Contraseña incorrecta', 401, $validacion->errors());
            }

            // Inicio de sesión manual
            //auth()->login($user);

            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return $responseApi->success("Inicio de sesión exitoso", 200, $user, $token);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Tokens revocados']);
    }



    public function sendVerificationEmail($user)
    {
        try {
            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify', // Nombre de la ruta
                now()->addDay(1), // Expiración de 24 horas
                ['id' => $user->id, 'hash' => sha1($user->getEmailForVerification())]
            );
    
            Mail::to($user->email)->send(new SendVerificationMail($user->nombre, $user->email , $verificationUrl));
        } catch (Exception $e) {
            throw new Exception("Error al enviar el correo de verificación: " . $e->getMessage());
        }
    }
    

    /*
    public function sendVerifiEmail($user)
    {
        try {
            //$user = User::where('email', '=', $email)->first();

            if ($user) {

                $verificationUrl = URL::temporarySignedRoute(
                    'verification.verify',
                    Carbon::now()->addDay(1),
                    ['id' => $user->id, 'hash' => sha1($user->getEmailForVerification())]
                );
                $nombre = $user->nombre . ' - ' . $user->apellido;

                Mail::to($user->email)->send(new SendVerifiMail($nombre, $verificationUrl));

                // Actualizar la columna email_verified_at si el correo se envía exitosamente
                //$user->email_verified_at = now();
                //$user->save();

                //return response()->json(['message' => 'Correo enviado con éxito.'], 200);

                /*$data = [
                    "userName" => $user->nombre
                ];*/
                //return true;

            /*}/* else {
                //return response()->json(['message' => 'Usuario no encontrado.'], 404);
                return ApiResponse::error("Usuario no encontrado.",404);
            }*//*
        } catch (Exception $e) {

            return response()->json("Error: " . $e->getMessage(), 401);

            //return false;
            //return ApiResponse::error("error: ".$e->getMessage(),404);
            //throw $th;
        }
    }

    */
}
