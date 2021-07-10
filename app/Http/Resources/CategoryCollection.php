<?php

namespace App\Http\Resources;

use App\Models\Category as Model;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Support\Collection
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($category) {
            return [
                'id' => $category->id,
                'title' => $category->title,
                'photo' => Model::getImagePath($category->photo),
            ];
        });
    }
}
