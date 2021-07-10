<?php

namespace App\Services\Category;

use App\Models\Category;

class CategoryService implements CategoryServiceInterface
{

    /**
     * @var Category
     */
    private $model;

    /**
     * ColorService constructor.
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
