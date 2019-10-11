<?php

namespace Emporio\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Emporio\Model\CategoryServices;
use Emporio\Model\Services;
use Emporio\Http\Resources\ServicesResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return 
        [
            'id' => $this->id,
            'categoria' => $this->categoria,
            'path' => $this->path,
            'imagen' => $this->imagen,
            'descripcion' => $this->descripcion,
            'icon' => $this->icon,
            'services' => ServicesResource::collection($this->services)
        ];
    }
}
