<?php

namespace App\Http\Resources;

use App\Models\Product as Model;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'description' => $this->description,
            'gender' => $this->gender,
            'primary_photo' => Model::getImagePath($this->primary_photo->photo ?? ''),
            'secondary_photo' => Model::getImagePath($this->secondary_photo->photo ?? ''),
            'photos' => $this->getPhotos(),
            'category' => $this->category,
            'status' => $this->status,
            'type_id' => $this->type_id,
            'color' => $this->color,
            'sizes' => $this->sizes,
        ];
    }

    private function getPhotos()
    {
        return array_map(function ($photo) {
            return Model::getImagePath($photo['photo']);
        }, $this->product_photos->toArray());
    }
}
