<?php

namespace App\Http\Controllers\user;

use Exception;
use App\Models\user\Sesion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Response\ResponseApi;

class SesionUserController extends Controller
{
    public function index()
    {
        $responseApi = new ResponseApi();
        try {
            // Usa 'user_fk' como el nombre de la relación
            $listaSesiones = Sesion::with('user_fk:id,nombre,apellido,email,estado')->get();
    
            if ($listaSesiones->isEmpty()) {
                return $responseApi->error("No se encontraron sesiones.", 404);
            }
    
            return $responseApi->success("Lista de sesiones cargada con éxito.", 200, $listaSesiones);
        } catch (Exception $th) {
            return $responseApi->error("Error al obtener la lista de sesiones: " . $th->getMessage(), 500);
        }
    }
    

    public function store(Request $request)
    {
        $responseApi = new ResponseApi();
        try {
            $validacion = Validator::make($request->all(), [
                'user_fk' => 'required|integer|exists:users,id',
                'estado_activo' => 'required|boolean',
                'fecha_inicio' => 'required|date',
            ]);

            if ($validacion->fails()) {
                return $responseApi->error("Validación fallida.", 400, $validacion->errors());
            }

            $nuevaSesion = Sesion::create($request->all());

            return $responseApi->success("Sesión creada con éxito.", 201, $nuevaSesion);
        } catch (Exception $th) {
            return $responseApi->error("Error: " . $th->getMessage(), 500);
        }
    }

    public function show($id)
    {
        $responseApi = new ResponseApi();
        try {
            $sesion = Sesion::find($id);

            if (!$sesion) {
                return $responseApi->error("Sesión no encontrada.", 404);
            }

            return $responseApi->success("Sesión encontrada.", 200, $sesion);
        } catch (Exception $th) {
            return $responseApi->error("Error: " . $th->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        $responseApi = new ResponseApi();
        try {
            $sesion = Sesion::find($id);

            if (!$sesion) {
                return $responseApi->error("Sesión no encontrada.", 404);
            }

            $validacion = Validator::make($request->all(), [
                'user_fk' => 'nullable|integer|exists:users,id',
                'estado_activo' => 'nullable|boolean',
                'fecha_inicio' => 'nullable|date',
            ]);

            if ($validacion->fails()) {
                return $responseApi->error("Validación fallida.", 400, $validacion->errors());
            }

            $sesion->update($request->all());

            return $responseApi->success("Sesión actualizada con éxito.", 200, $sesion);
        } catch (Exception $th) {
            return $responseApi->error("Error: " . $th->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        $responseApi = new ResponseApi();
        try {
            $sesion = Sesion::find($id);

            if (!$sesion) {
                return $responseApi->error("Sesión no encontrada.", 404);
            }

            $sesion->delete();

            return $responseApi->success("Sesión eliminada con éxito.", 200, "");
        } catch (Exception $th) {
            return $responseApi->error("Error: " . $th->getMessage(), 500);
        }
    }
}
