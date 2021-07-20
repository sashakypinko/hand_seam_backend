<?php

namespace App\Http\Controllers;

use App\Facades\Statistic;
use App\Http\Requests\CartItemRequest;
use App\Http\Resources\CartItemCollection;
use App\Repositories\CartItem\CartItemRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartItemController extends Controller
{

    /**
     * @var CartItemRepository
     */
    private $cartItem;

    /**
     * CartController constructor.
     * @param CartItemRepository $cartItem
     */
    public function __construct(CartItemRepository $cartItem)
    {
        $this->cartItem = $cartItem;
    }

    /**
     * @return CartItemCollection
     */
    public function get(): CartItemCollection
    {
        return new CartItemCollection($this->cartItem->get());
    }

    /**
     * @param CartItemRequest $request
     * @return JsonResponse
     */
    public function create(CartItemRequest $request): JsonResponse
    {
        $data = $request->get('order');

        $cartItem = $this->cartItem->find($data);

        if ($cartItem) {
            $this->cartItem->update($cartItem, $data['count']);
        } else {
            $this->cartItem->create($data);
            Statistic::addedToCart($data['product']['id']);
        }

        return new JsonResponse(
            new CartItemCollection($this->cartItem->get()),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @param CartItemRequest $request
     * @return JsonResponse
     */
    public function delete(CartItemRequest $request): JsonResponse
    {
        $this->cartItem->delete($request->get('id'));

        return new JsonResponse(
            new CartItemCollection($this->cartItem->get()),
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
                'count' => $this->cartItem->getItemsCount(),
                'totalPrice' => $this->cartItem->getItemsTotalPrice()
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
        $this->cartItem->changeCount($request->get('id'), $request->get('count'));

        return new JsonResponse(
            ['status' => 'OK'],
            JsonResponse::HTTP_OK
        );
    }
}
