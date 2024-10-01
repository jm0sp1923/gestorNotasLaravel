<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();  // id como clave primaria
            $table->string('titulo');  // título de la nota
            $table->text('descripcion');  // descripción de la nota
            $table->timestamp('fecha_creacion')->useCurrent();  // fecha de creación
            $table->date('fecha_vencimiento')->nullable();  // fecha de vencimiento opcional
            $table->longText('imagen')->nullable();  // imagen opcional
            $table->unsignedBigInteger('usuario_id'); // clave foránea usuario
            $table->unsignedBigInteger('etiqueta_id')->nullable();//clave foranea etiqueta
            $table->timestamps();  // created_at y updated_at

            // Clave foránea a la tabla 'usuarios'
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('etiqueta_id')->references('id')->on('etiquetas')->onDelete('cascade');
  
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
