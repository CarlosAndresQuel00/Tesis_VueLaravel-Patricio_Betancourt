<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Assignment extends JsonResource
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
            'membership' => '/api/memberships/' . $this->mem_id,
            'client' => '/api/clients/' . $this->cli_id,
            'detalle' => $this->detalle_assig,
            'fecha' => $this->fecha_assig,
            'estado' => $this->estado_assig,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
