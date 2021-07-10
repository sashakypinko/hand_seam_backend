<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * @var ProductServiceInterface
     */
    private $service;

    /**
     * ProductController constructor.
     * @param ProductServiceInterface $service
     */
    public function __construct(ProductServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return ProductCollection
     */
    public function getAll(Request $request): ProductCollection
    {
        $data = $this->service->get($request->all());

        return new ProductCollection($data['products'], $data['total']);
    }

    public function get(Request $request)
    {
        return new ProductResource($this->service->byId($request->get('id')));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPriceRange(Request $request): JsonResponse
    {
        try {
            return new JsonResponse($this->service->getPriceRange($request->all()), JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
