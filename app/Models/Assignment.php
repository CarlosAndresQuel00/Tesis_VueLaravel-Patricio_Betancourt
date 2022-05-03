<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $fillable = ['detalle_assig', 'fecha_assig', 'estado_assig'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
