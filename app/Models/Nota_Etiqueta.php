<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Nota_Etiqueta extends Model
{
    use HasFactory;
    protected $fillable = ['nota_id', 'etiqueta_id'];

    public function nota()
    {
        return $this->belongsTo(Nota::class, 'nota_id');
    }

    public function etiqueta()
    {
        return $this->belongsTo(Etiqueta::class, 'etiqueta_id');
    }
}
