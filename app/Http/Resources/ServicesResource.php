<?php

namespace Emporio\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return 
        [
            'id' => $this->id,
            'servicio' => $this->servicio,
            'path' => $this->slug,
            'descripcion' => $this->descripcion
        ];
    }
}
