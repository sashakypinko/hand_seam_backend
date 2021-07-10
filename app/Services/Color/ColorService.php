<?php

namespace App\Services\Color;

use App\Models\Color;

class ColorService implements ColorServiceInterface
{

    /**
     * @var Color
     */
    private $model;

    /**
     * ColorService constructor.
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
