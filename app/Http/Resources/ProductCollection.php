<?php

namespace App\Http\Resources;

use App\Models\Product as Model;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class ProductCollection extends ResourceCollection
{

    /**
     * @var int
     */
    private $total;

    /**
     * ProductCollection constructor.
     * @param $resource
     * @param $total
     */
    public function __construct($resource, int $total)
    {
        parent::__construct($resource);
        $this->total = $total;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->mapCollection(),
            'total' => $this->total
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function mapCollection(): Collection
    {
        return $this->collection->transform(function ($product) {
            return new Product($product);
        });
    }
}
