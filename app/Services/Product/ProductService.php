<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Services\ProductFilter\ProductFilter;

class ProductService implements ProductServiceInterface
{

    public const LIMIT = 8;

    /**
     * @var Product
     */
    private $model;

    /**
     * ProductService constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function get($request)
    {
        $builder = $this->model::select('products.*', 'product_photos.photo')
            ->with('product_photos', 'color')
            ->leftJoin('product_photos', 'product_photos.product_id', '=', 'products.id')
            ->leftJoin('product_sizes', 'product_sizes.product_id', '=', 'products.id');

        if (isset($request['filter'])) {
            $productFilter = new ProductFilter($request);

            $builder = $productFilter->applyFilter($builder);
        }

        $builder->groupBy('products.id');

        return [
            'products' => $builder->paginate(Product::MAX_ITEMS),
            'total' => $builder->count()
        ];
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function byId(int $id)
    {
        return $this->model::select('products.*', 'product_photos.photo')
            ->with(['product_photos', 'color', 'sizes'])
            ->leftJoin('product_photos', 'product_photos.product_id', '=', 'products.id')
            ->where('products.id', $id)
            ->groupBy('products.id')
            ->first();
    }

    /**
     * @return array
     */
    public function getPriceRange(): array
    {
        $minPrice = $this->model->orderBy('price', 'ASC')->first();
        $maxPrice = $this->model->orderBy('price', 'DESC')->first();

        return ['min' => $minPrice->price, 'max' => $maxPrice->price];
    }
}
