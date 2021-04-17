<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\GigResource;

class GigCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'gigs' => GigResource::collection($this->collection),
            'count' => $this->collection->count()
        ];
        //parent::toArray($request);
    }
}
