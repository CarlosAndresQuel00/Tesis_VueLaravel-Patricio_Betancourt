<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedSpace extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_ec', 'detalle_ec', 'estado_ec'];
}
