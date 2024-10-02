<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory; 
    
    // Definir la tabla asociada
    protected $table = 'notas';

    // Los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_creacion',
        'fecha_vencimiento',
        'imagen',
        'usuario_id',
        'etiqueta_id', // Esto se puede mantener si tienes una clave foránea directa a etiquetas
    ];

    // Relación: Una nota pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación: Una nota pertenece a una etiqueta
    public function etiqueta()
    {
        return $this->belongsTo(Etiqueta::class, 'etiqueta_id');
    }
}
