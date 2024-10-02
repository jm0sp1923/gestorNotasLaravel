<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticable
{
  
    use HasApiTokens,HasFactory,Notifiable;

    protected $table = 'usuarios';


    protected $fillable = [
        'nombre',
        'email',
        'password',
    ];  

    
    public function notas()
    {
        return $this->hasMany(Nota::class, 'usuario_id');
    }

}
