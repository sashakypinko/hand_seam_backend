<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\SizeCollection;
use App\Services\Size\SizeServiceInterface;

class SizeController extends Controller
{

    private $service;

    public function __construct(SizeServiceInterface $service)
    {
        $this->service = $service;
    }

    public function getAll(): SizeCollection
    {
        return new SizeCollection($this->service->all());
    }
}
