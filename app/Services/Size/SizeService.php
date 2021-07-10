<?php

namespace App\Services\Size;

use App\Models\Size;

class SizeService implements SizeServiceInterface
{

    /**
     * @var Size
     */
    private $model;

    /**
     * SizeService constructor.
     * @param Size $model
     */
    public function __construct(Size $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model::get();
    }
}
