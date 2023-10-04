<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TareaController extends Controller
{
    public function InsertarTarea(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'titulo' => 'required|string|max:255',
                'contenido' => 'required|string|max:255',
                'estado' => 'required|string|max:25',
                'autor' => 'required|string|min:3|max:255',
            ]);

            if ($validation->fails()) {
                return response($validation->errors(), 403);
            }

            $tarea = new Tarea();

            $tarea->titulo = $request->post('titulo');
            $tarea->contenido = $request->post('contenido');
            $tarea->estado = $request->post('estado');
            $tarea->autor = $request->post('autor');

            $tarea->save();

            return $tarea;
        } catch (\Exception $e) {
            return response(['error' => 'Ha ocurrido un error en la solicitud'], 500);
        }
    }

    public function ListarTareas(Request $request)
    {
        try {
            return Tarea::all();
        } catch (\Exception $e) {
            return response(['error' => 'Ha ocurrido un error en la solicitud'], 500);
        }
    }

    public function ListarUnaTarea(Request $request, $idTarea)
    {
        try {
            $tarea = Tarea::findOrFail($idTarea);
            return $tarea;
        } catch (ModelNotFoundException $e) {
            return response(['error' => 'La tarea no existe'], 404);
        } catch (\Exception $e) {
            return response(['error' => 'Ha ocurrido un error en la solicitud'], 500);
        }
    }

    public function ModificarTarea(Request $request, $idTarea)
    {
        try {
            $tarea = Tarea::findOrFail($idTarea);

            $validation = Validator::make($request->all(), [
                'titulo' => 'required|string|max:255',
                'contenido' => 'required|string|max:255',
                'estado' => 'required|string|max:25',
                'autor' => 'required|string|min:3|max:255',
            ]);

            if ($validation->fails()) {
                return response($validation->errors(), 403);
            }

            $tarea->update($request->all());

            $tarea->save();

            return $tarea;
        } catch (ModelNotFoundException $e) {
            return response(['error' => 'La tarea no existe'], 404);
        } catch (\Exception $e) {
            return response(['error' => 'Ha ocurrido un error en la solicitud'], 500);
        }
    }

    public function EliminarTarea(Request $request, $idTarea)
    {
        try {
            $tarea = Tarea::findOrFail($idTarea);

            $tarea->delete();

            return [
                "mensaje" => "La tarea con ID $idTarea ha sido eliminada correctamente"
            ];
        } catch (ModelNotFoundException $e) {
            return response(['error' => 'La tarea no existe'], 404);
        } catch (\Exception $e) {
            return response(['error' => 'Ha ocurrido un error en la solicitud'], 500);
        }
    }

    public function BuscarPorTitulo(Request $request, $titulo)
    {
        try {
            $tareas = Tarea::where('titulo', $titulo)->get();

            if ($tareas->isEmpty()) {
                return response(['message' => 'No hay tareas con ese título'], 404);
            }

            return $tareas;
        } catch (\Exception $e) {
            return response(['error' => 'Ha ocurrido un error en la solicitud'], 500);
        }
    }

    public function BuscarPorAutor(Request $request, $autor)
    {
        try {
            $tareas = Tarea::where('autor', $autor)->get();

            if ($tareas->isEmpty()) {
                return response(['message' => 'No hay tareas con ese autor'], 404);
            }

            return $tareas;
        } catch (\Exception $e) {
            return response(['error' => 'Ha ocurrido un error en la solicitud'], 500);
        }
    }

    public function BuscarPorEstado(Request $request, $estado)
    {
        try {
            $tareas = Tarea::where('estado', $estado)->get();

            if ($tareas->isEmpty()) {
                return response(['message' => 'No hay tareas con ese estado'], 404);
            }

            return $tareas;
        } catch (\Exception $e) {
            return response(['error' => 'Ha ocurrido un error en la solicitud'], 500);
        }
    }
}
