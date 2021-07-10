<?php

namespace App\Services\ProductFilter;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter
{

    /**
     * @var
     */
    private $search;

    /**
     * @var
     */
    private $categories;

    /**
     * @var
     */
    private $sizes;

    /**
     * @var
     */
    private $colors;

    /**
     * @var
     */
    private $genders;

    /**
     * @var
     */
    private $price;

    /**
     * ProductFilter constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->setFilterParams(json_decode($request['filter']));
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function applyFilter(Builder $builder): Builder
    {
        return $builder->where(function ($query) {
            return $query->when($this->categories, function ($query) {
                return $query->orWhereIn('products.category_id', $this->categories);
            })
                ->when($this->sizes, function ($query) {
                    return $query->orWhereIn('product_sizes.size_id', $this->sizes);
                })
                ->when($this->colors, function ($query) {
                    return $query->orWhereIn('products.color_id', $this->colors);
                })
                ->when($this->genders, function ($query) {
                    return $query->orWhereIn('products.gender', $this->genders);
                })
                ->when($this->price, function ($query) {
                    return $query->where('products.price', '>=', $this->price->min)
                        ->where('products.price', '<=', $this->price->max);
                })
                ->when($this->search, function ($query) {
                    return $query->where('products.name', 'LIKE', "%$this->search%");
                });
        });
    }

    /**
     * @param $search
     */
    private function setSearch($search)
    {
        $this->search = $search;
    }

    /**
     * @param $categories
     */
    private function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @param $sizes
     */
    private function setSizes($sizes)
    {
        $this->sizes = $sizes;
    }

    /**
     * @param $colors
     */
    private function setColors($colors)
    {
        $this->colors = $colors;
    }

    /**
     * @param $genders
     */
    private function setGenders($genders)
    {
        $this->genders = $genders;
    }

    /**
     * @param $price
     */
    private function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param $params
     */
    private function setFilterParams($params)
    {
        foreach ($params as $name => $value) {
            $setter = $this->getSetterName($name);

            if (method_exists(static::class, $setter)) {
                $this->$setter($value);
            }
        }
    }

    /**
     * @param $name
     * @return string
     */
    private function getSetterName($name): string
    {
        return 'set' . ucfirst($name);
    }
}
