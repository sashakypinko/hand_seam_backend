<?php

namespace App\Repositories\Color;

use App\Models\Color;

class Eloquent implements ColorRepository
{

    /**
     * @var Color
     */
    private $model;

    /**
     * Eloquent constructor.
     * @param Color $model
     */
    public function __construct(Color $model)
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
