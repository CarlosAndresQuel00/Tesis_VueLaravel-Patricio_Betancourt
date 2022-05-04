<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Payment extends JsonResource
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
            'assignment' => '/api/assignments/' . $this->assignment_id,
            'contrapartida' => $this->contrapartida_pay,
            'entidad' => $this->entidadfin_pay,
            'evidencia' => $this->evidencia_pay,
            'fechapago' => $this->fechapago_pay,
            'fecharegpago' => $this->fecharegpago_pay,
            'estado' => $this->estado_pay,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
