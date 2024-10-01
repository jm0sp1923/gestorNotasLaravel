<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = 'etiquetas';

    // Los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
    ];

    // Relación: Una etiqueta puede pertenecer a muchas notas (relación muchos a muchos)
    public function notes()
    {
        return $this->belongsToMany(Nota::class, 'nota_etiqueta', 'etiqueta_id', 'nota_id')
                    ->withTimestamps();
    }
}
