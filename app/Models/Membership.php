<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_mem', 'detalle_mem', 'hcowork_mem','hespacios_mem','fechacorte_mem', 'estado_mem'];

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
