<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Repositories\Category\CategoryRepository;

class CategoryController extends Controller
{

    /**
     * @var CategoryRepository
     */
    private $category;


    /**
     * CategoryController constructor.
     * @param CategoryRepository $category
     */
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * @return CategoryCollection
     */
    public function getAll(): CategoryCollection
    {
        return new CategoryCollection($this->category->all());
    }
}
