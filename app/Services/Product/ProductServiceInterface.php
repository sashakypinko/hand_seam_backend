<?php

namespace App\Services\Product;

interface ProductServiceInterface
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
}
