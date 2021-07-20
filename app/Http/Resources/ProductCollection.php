<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
     * @param int $total
     */
    public function __construct($resource, int $total = 0)
    {
        parent::__construct($resource);
        $this->total = $total;
    }

    /**
     * @param Request $request
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
     * @return Collection
     */
    private function mapCollection(): Collection
    {
        return $this->collection->transform(function ($product) {
            return new Product($product);
        });
    }
}
