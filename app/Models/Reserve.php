<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;
    protected $fillable=['detalle_rsv','fechahi_rsv','fechahf_rsv','estado_rsv'];
}
