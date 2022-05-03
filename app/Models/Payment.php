<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable=['contrapartida_pay','entidadfin_pay','evidencia_pay','fechapago_pay','fecharegpago_pay','estado_pay'];
}
