<?php

namespace App\Http\Controllers;

use App\Facades\Statistic;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Color\ColorRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Size\SizeRepository;
use Illuminate\Http\JsonResponse;

class ProductFilterController extends Controller
{

    /**
     * @var CategoryRepository
     */
    private $category;

    /**
     * @var ColorRepository
     */
    private $color;

    /**
     * @var SizeRepository
     */
    private $size;

    /**
     * @var ProductRepository
     */
    private $product;

    /**
     * ProductFilterController constructor.
     *
     * @param CategoryRepository $category
     * @param ColorRepository $color
     * @param SizeRepository $size
     * @param ProductRepository $product
     */
    public function __construct(
        CategoryRepository $category,
        ColorRepository $color,
        SizeRepository $size,
        ProductRepository $product
    )
    {
        $this->category = $category;
        $this->color = $color;
        $this->size = $size;
        $this->product = $product;
    }

    /**
     * @return JsonResponse
     */
    public function getFilterFields()
    {

        try {
            $filterFields = [
                'categories' => $this->category->all(),
                'colors' => $this->color->all(),
                'sizes' => $this->size->all(),
                'priceRange' => $this->product->getPriceRange()
            ];

            return new JsonResponse($filterFields, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
