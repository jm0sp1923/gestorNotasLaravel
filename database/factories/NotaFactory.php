<?php

namespace Database\Factories;

use App\Models\Etiqueta;
use App\Models\Nota;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NotaFactory extends Factory
{
    protected $model = Nota::class;

    public function definition()
    {
        // Generar un nombre único para la imagen
        $imagenNombre = Str::random(10) . '.jpg'; // Cambia la extensión según sea necesario
        // Aquí podrías agregar lógica para mover una imagen de ejemplo a public/storage/imagenes
        // o generar una imagen dinámica.

        return [
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'fecha_vencimiento' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'imagen' => 'imagenes/' . $imagenNombre, // Guardar la ruta de la imagen
            'usuario_id' => Usuario::factory(), 
        ];
    }
}
