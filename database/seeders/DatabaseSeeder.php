<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Nota;
use App\Models\Etiqueta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         Usuario::factory(5)->create(); 
         Etiqueta::factory(3)->create(); 
         Nota::factory(5)->create()->each(function ($nota) {
            $nota->etiqueta_id = Etiqueta::inRandomOrder()->first()->id; 
            $nota->save();  
        });

    }
}
