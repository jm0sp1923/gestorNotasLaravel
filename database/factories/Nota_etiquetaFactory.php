<?php

namespace Database\Factories;
use App\Models\Nota_Etiqueta;
use App\Models\Nota;
use App\Models\Etiqueta;
use Illuminate\Database\Eloquent\Factories\Factory;


class Nota_etiquetaFactory extends Factory
{
    protected $model = Nota_Etiqueta::class;

    public function definition()
    {
        return [
            'nota_id' => Nota::factory(), // Crea una nueva nota
            'etiqueta_id' => Etiqueta::factory(), // Crea una nueva etiqueta
        ];
    }
}
