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
}
