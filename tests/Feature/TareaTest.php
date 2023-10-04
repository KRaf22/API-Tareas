<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tarea;

class TareaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_InsertarTarea()
    {
        $response = $this -> post('/api/tareas',[
            "titulo" => "MER",
            "contenido" => "Realizar Modelo Entidad Relacion de Polo Logistico",
            "estado" => "En proceso",
            "autor" => "Gonzalo",
        ]);

        $response->assertStatus(201);

        $response->assertJsonCount(7);

        $this->assertDatabaseHas('tareas', [
            "titulo" => "MER",
            "contenido" => "Realizar Modelo Entidad Relacion de Polo Logistico",
            "estado" => "En proceso",
            "autor" => "Gonzalo",
        ]);

    }

    public function test_InsertarTareaConErrores()
    {
        $response = $this -> post('/api/tareas',[
            "contenido" => "Realizar Modelo Entidad Relacion de Polo Logistico",
            "estado" => "En proceso",
            "autor" => "Gonzalo",
        ]);

        $response->assertStatus(403);

    }

    public function test_ListarTareas()
    {
        $response = $this -> get('/api/tareas');

        $response->assertStatus(200);

        $response->assertJsonStructure([
                 [
                    'id',
                    'titulo',
                    'contenido',
                    'estado',
                    'autor',
                    'created_at',
                    'updated_at',
                    'deleted_at'
                ]
        ]);
        
    }

    public function test_ListarTareaExistente()
    {
        $estructura = [
            'id',
            'titulo',
            'contenido',
            'estado',
            'autor',
            'created_at',
            'updated_at',
            'deleted_at'
        ];

        $response = $this -> get('/api/tareas/1');

        $response->assertStatus(200);

        $response->assertJsonCount(8);

        $response->assertJsonStructure($estructura);
    }

    public function test_ListarTareaInexistente()
    {
        $response = $this -> get('api/tareas/98992');

        $response->assertStatus(404);

    }

}
