<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etiquetas', function (Blueprint $table) {
            $table->id();  // id como clave primaria
            $table->string('nombre');  // nombre de la etiqueta
            $table->timestamps();  // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etiquetas');
    }
};
