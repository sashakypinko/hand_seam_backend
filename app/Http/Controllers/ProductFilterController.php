<?php

namespace App\Http\Controllers;

use App\Services\Category\CategoryServiceInterface;
use App\Services\Color\ColorServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\Size\SizeServiceInterface;
use Illuminate\Http\JsonResponse;

class ProductFilterController
{

    /**
     * @var CategoryServiceInterface
     */
    private $categoryService;

    /**
     * @var ColorServiceInterface
     */
    private $colorService;

    /**
     * @var SizeServiceInterface
     */
    private $sizeService;

    /**
     * @var ProductServiceInterface
     */
    private $productService;

    /**
     * ProductFilterController constructor.
     * @param CategoryServiceInterface $categoryService
     * @param ColorServiceInterface $colorService
     * @param SizeServiceInterface $sizeService
     * @param ProductServiceInterface $productService
     */
    public function __construct(
        CategoryServiceInterface $categoryService,
        ColorServiceInterface $colorService,
        SizeServiceInterface $sizeService,
        ProductServiceInterface $productService
    )
    {
        $this->categoryService = $categoryService;
        $this->colorService = $colorService;
        $this->sizeService = $sizeService;
        $this->productService = $productService;
    }

    /**
     * @return JsonResponse
     */
    public function getFilterFields(): JsonResponse
    {
        try {
            $filterFields = [
                'categories' => $this->categoryService->all(),
                'colors' => $this->colorService->all(),
                'sizes' => $this->sizeService->all(),
                'priceRange' => $this->productService->getPriceRange()
            ];

            return new JsonResponse($filterFields, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
