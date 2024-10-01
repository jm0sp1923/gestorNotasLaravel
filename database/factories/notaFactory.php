<?php

namespace Database\Factories;

use App\Models\Etiqueta;
use App\Models\Nota;
use App\Models\Usuario; // Asegúrate de incluir el modelo Usuario
use Illuminate\Database\Eloquent\Factories\Factory;

class NotaFactory extends Factory
{
    protected $model = Nota::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'fecha_vencimiento' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'imagen' =>$this-> faker->imageUrl(640, 480, 'people', true), 
            'usuario_id' => Usuario::factory(), 
        ];
    }
}
