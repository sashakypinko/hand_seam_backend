<?php

namespace App\Repositories\Size;

use App\Models\Size;

class Eloquent implements SizeRepository
{

    /**
     * @var Size
     */
    private $model;

    /**
     * Eloquent constructor.
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
