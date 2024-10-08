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

    public function notas()
    {
        return $this->hasMany(Nota::class, 'etiqueta_id'); 
    }
}
