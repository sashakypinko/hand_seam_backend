<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Services\Category\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * @var CategoryServiceInterface
     */
    private $service;


    /**
     * CategoryController constructor.
     * @param CategoryServiceInterface $service
     */
    public function __construct(CategoryServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @return CategoryCollection
     */
    public function getAll(): CategoryCollection
    {
        return new CategoryCollection($this->service->all());
    }
}
