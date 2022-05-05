<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;
    protected $fillable=['assig_id','ec_id','detalle_rsv','fechahi_rsv','fechahf_rsv','estado_rsv'];

    public function sharedSpace()
    {
        return $this->belongsTo(SharedSpace::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
