<?php

namespace App\Repositories\Category;

use App\Models\Category;

class Eloquent implements CategoryRepository
{

    /**
     * @var Category
     */
    private $model;

    /**
     * Eloquent constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
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
