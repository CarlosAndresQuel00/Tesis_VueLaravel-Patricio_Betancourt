<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Reserve extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'assignment' => '/api/assignments/' . $this->assig_id,
            'sharedSpace' => '/api/shared_spaces/' . $this->ec_id,
            'detalle' => $this->detalle_rsv,
            'fechai' => $this->fechahi_rsv,
            'fechaf' => $this->fechahf_rsv,
            'estado' => $this->estado_rsv,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
