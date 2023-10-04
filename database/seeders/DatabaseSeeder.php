<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Tarea::factory(10)->create();
         \App\Models\Tarea::factory(1)->create(
            [ "titulo" => "Bucles PHP",
            "contenido" => "Capacitar sobre los bucles en PHP",
            "autor" => "Mateo",
            "estado" => "Completado"
            ]
        );
    }
}
