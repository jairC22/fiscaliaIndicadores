<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseApi;
use App\Models\user\roles;
use Illuminate\Support\Facades\Validator;
use Exception;


class RolesController extends Controller
{
    public function index()
    {
        $responseApi = new ResponseApi();
        try {
            $listaRoles = roles::all();

            if ($listaRoles->isEmpty()) {
                return $responseApi->error("No se encontraron roles.", 404);
            }

            return $responseApi->success("Lista de roles cargada con éxito.", 200, $listaRoles);
        } catch (Exception $th) {
            return $responseApi->error("Error al obtener la lista de roles: " . $th->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        $responseApi = new ResponseApi();
        try {
            $validacion = Validator::make($request->all(), [
                'roles' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:200',
            ]);

            if ($validacion->fails()) {
                return $responseApi->error("Validación fallida.", 400, $validacion->errors());
            }

            $nuevoRol = Roles::create($request->all());

            if (!$nuevoRol) {
                return $responseApi->error("Error al crear el rol.", 500);
            }

            return $responseApi->success("Rol creado con éxito.", 201, $nuevoRol);
        } catch (Exception $th) {
            return $responseApi->error("Error: " . $th->getMessage(), 500);
        }
    }

    public function show($id)
    {
        $responseApi = new ResponseApi();
        try {
            $rol = Roles::find($id);

            if (!$rol) {
                return $responseApi->error("Rol no encontrado.", 404);
            }

            return $responseApi->success("Rol encontrado.", 200, $rol);
        } catch (Exception $th) {
            return $responseApi->error("Error: " . $th->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        $responseApi = new ResponseApi();
        try {
            $rol = roles::find($id);

            if (!$rol) {
                return $responseApi->error("Rol no encontrado.", 404);
            }

            $validacion = Validator::make($request->all(), [
                'roles' => 'nullable|string|max:255',
                'descripcion' => 'nullable|string|max:200',
            ]);

            if ($validacion->fails()) {
                return $responseApi->error("Validación fallida.", 400, $validacion->errors());
            }

            $rol->update($request->all());

            return $responseApi->success("Rol actualizado con éxito.", 200, $rol);
        } catch (Exception $th) {
            return $responseApi->error("Error: " . $th->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        $responseApi = new ResponseApi();
        try {
            $rol = roles::find($id);

            if (!$rol) {
                return $responseApi->error("Rol no encontrado.", 404);
            }

            $rol->delete();

            return $responseApi->success("Rol eliminado con éxito.", 200,"");
        } catch (Exception $th) {
            return $responseApi->error("Error: " . $th->getMessage(), 500);
        }
    }
}
