<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Statistic\StatisticRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * @var ProductRepository
     */
    private $product;

    /**
     * @var StatisticRepository
     */
    private $statistic;

    /**
     * ProductController constructor.
     *
     * @param ProductRepository $product
     * @param StatisticRepository $statistic
     */
    public function __construct(ProductRepository $product, StatisticRepository $statistic)
    {
        $this->product = $product;
        $this->statistic = $statistic;
    }

    /**
     * @param Request $request
     * @return ProductCollection
     */
    public function getAll(Request $request): ProductCollection
    {
        $data = $this->product->get($request->all());

        return new ProductCollection($data['products'], $data['total']);
    }

    /**
     * @param Request $request
     * @return ProductResource
     */
    public function get(Request $request): ProductResource
    {
        return new ProductResource($this->product->byId($request->get('id')));
    }

    /**
     * @param Request $request
     * @return ProductCollection
     */
    public function getPopularProducts(Request $request): ProductCollection
    {
        return new ProductCollection($this->product->getPopularProducts($request->get('limit')));
    }

    /**
     * @return JsonResponse
     */
    public function getPriceRange(): JsonResponse
    {
        try {
            return new JsonResponse($this->product->getPriceRange(), JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
