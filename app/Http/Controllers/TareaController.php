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
}
