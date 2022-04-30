<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable=[
        'identificacion_cli',
        'nombres_cli',
        'apellidos_cli',
        'empresa_cli',
        'direccion_cli',
        'email_cli',
        'telf_cli',
        'tipo_cli',
        'estado_cli',
    ];
}
