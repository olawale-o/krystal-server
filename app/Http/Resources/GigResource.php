<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RegionResource;

class GigResource extends JsonResource
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
            'company' => $this->company,
            'role' => $this->role,
            'tags' => $this->tags,
            'address' => $this->address,
            'region' => new RegionResource($this->region),
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
            'created_at' => date("jS\, F Y",strtotime($this->created_at)),
        ];
        //parent::toArray($request);
    }
}
