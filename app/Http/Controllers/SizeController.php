<?php

namespace App\Http\Controllers;

use App\Http\Resources\SizeCollection;
use App\Repositories\Size\SizeRepository;

class SizeController extends Controller
{

    /**
     * @var SizeRepository
     */
    private $size;

    /**
     * SizeController constructor.
     * @param SizeRepository $size
     */
    public function __construct(SizeRepository $size)
    {
        $this->size = $size;
    }

    /**
     * @return SizeCollection
     */
    public function getAll(): SizeCollection
    {
        return new SizeCollection($this->size->all());
    }
}
