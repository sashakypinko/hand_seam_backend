<?php

namespace App\Repositories\Product;

interface ProductRepository
{

    /**
     * @param $request
     * @return mixed
     */
    public function get($request);

    /**
     * @param int $id
     * @return mixed
     */
    public function byId(int $id);

    /**
     * @return mixed
     */
    public function getPriceRange();

    /**
     * @param int $limit
     * @return mixed
     */
    public function getPopularProducts(int $limit = 8);
}
