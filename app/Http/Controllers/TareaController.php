<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use Illuminate\Support\Facades\Validator;

class TareaController extends Controller
{
    public function InsertarTarea(Request $request){
        $validation = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string|max:255',
            'estado' => 'required|string|max:25',
            'autor' => 'required|string|min:3|max:255',
        ]);

        if($validation->fails())
            return response($validation->errors(),403);

        $tarea=new Tarea();

        $tarea -> titulo = $request -> post ('titulo');
        $tarea -> contenido = $request -> post ('contenido');
        $tarea -> estado = $request -> post ('estado');
        $tarea -> autor = $request -> post ('autor');

        $tarea -> save();

        return $tarea;
    }

    public function ListarTareas(Request $request){
        return Tarea::all();
    }

    public function ListarUnaTarea(Request $request, $idTarea){
        return Tarea::findOrFail($idTarea);
    }

    public function ModificarTarea(Request $request, $idTarea){
        $tarea=Tarea::findOrFail($idTarea);

        $validation = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string|max:255',
            'estado' => 'required|string|max:25',
            'autor' => 'required|string|min:3|max:255',
        ]);

        if($validation->fails())
            return response($validation->errors(),403);

        $tarea -> update($request->all());

        $tarea -> save();

        return $tarea;

    }

    public function EliminarTarea(Request $request, $idTarea){
        $tarea=Tarea::findOrFail($idTarea);

        $tarea -> delete();

        return [
            "mensaje" => "La tarea con id $idTarea ha sido eliminada correctamente"
        ];
    }

    public function BuscarPorTitulo(Request $request, $titulo){
        $tareas = Tarea::where('titulo', $titulo)->get();

        if ($tareas->isEmpty()) {
            return response(['message' => 'No hay tareas con ese título'], 404);
        }
    
        return $tareas;
    }

    public function BuscarPorAutor(Request $request, $autor){
        $tareas = Tarea::where('autor', $autor)->get();

        if ($tareas->isEmpty()) {
            return response(['message' => 'No hay tareas con ese autor'], 404);
        }

        return $tareas;
    }

    public function BuscarPorEstado(Request $request, $estado){
        $tareas = Tarea::where('estado', $estado)->get();

        if ($tareas->isEmpty()) {
            return response(['message' => 'No hay tareas con ese estado'], 404);
        }

        return $tareas;
    }
}
