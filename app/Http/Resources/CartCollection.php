<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($item) {
            return new Cart($item);
        });
    }
}
