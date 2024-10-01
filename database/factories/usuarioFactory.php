<?php

namespace Database\Factories;

use App\Models\Usuario;
use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class usuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => hash::make('password'), 
        ];
    }
}