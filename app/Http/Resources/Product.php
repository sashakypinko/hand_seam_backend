<?php

namespace App\Http\Resources;

use App\Models\Product as Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed price
 * @property mixed old_price
 * @property mixed description
 * @property mixed gender
 * @property mixed primary_photo
 * @property mixed status
 * @property mixed secondary_photo
 * @property mixed category
 * @property mixed type_id
 * @property mixed color
 * @property mixed sizes
 * @property mixed related_products
 * @property mixed product_photos
 */
class Product extends JsonResource
{

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'description' => $this->description,
            'gender' => $this->gender,
            'primary_photo' => $this->primary_photo,
            'secondary_photo' => $this->secondary_photo,
            'photos' => $this->getPhotos(),
            'category' => $this->category,
            'status' => $this->status,
            'type_id' => $this->type_id,
            'color' => $this->color,
            'sizes' => $this->sizes,
            'related_products' => $this->related_products,
        ];
    }

    /**
     * @return array
     */
    private function getPhotos(): array
    {
        return array_map(function ($photo) {
            return Model::getImagePath($photo['photo']);
        }, $this->product_photos->toArray());
    }
}
