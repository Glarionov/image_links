<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LinkCollection extends ResourceCollection
{

    public $collects = LinkResource::class;

    /**
     * Transform the resource collection into an array.
     */
    public function toArray($request) : array
    {
        return [
            'data' => $this->collection->keyBy('id'),
        ];
    }

}
