<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartCollection;
use App\Services\Cart\CartServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * @var CartServiceInterface
     */
    private $service;

    /**
     * CartController constructor.
     * @param CartServiceInterface $service
     */
    public function __construct(CartServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @return CartCollection
     */
    public function get(): CartCollection
    {
        return new CartCollection($this->service->get());
    }

    /**
     * @param CartRequest $request
     * @return JsonResponse
     */
    public function create(CartRequest $request): JsonResponse
    {
        $this->service->createOrUpdate($request->get('order'));

        return new JsonResponse(
            new CartCollection($this->service->get()),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @param CartRequest $request
     * @return JsonResponse
     */
    public function delete(CartRequest $request): JsonResponse
    {
        $this->service->delete($request->get('id'));

        return new JsonResponse(
            new CartCollection($this->service->get()),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @return JsonResponse
     */
    public function getItemsCount(): JsonResponse
    {
        return new JsonResponse(
            [
                'count' => $this->service->getItemsCount(),
                'totalPrice' => $this->service->getItemsTotalPrice()
            ],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeCount(Request $request): JsonResponse
    {
        $this->service->changeCount($request->get('id'), $request->get('count'));

        return new JsonResponse(
            ['status' => 'OK'],
            JsonResponse::HTTP_OK
        );
    }
}
