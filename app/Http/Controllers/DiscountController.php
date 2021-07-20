<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Repositories\Discount\DiscountRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    /**
     * @var DiscountRepository
     */
    private $discount;

    /**
     * DiscountController constructor.
     *
     * @param DiscountRepository $discount
     */
    public function __construct(DiscountRepository $discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        return new JsonResponse([
            Discount::TRIGGERS[Discount::TRIGGER_VISIT] => $this->discount->getVisitDiscount(),
            Discount::TRIGGERS[Discount::TRIGGER_PAYMENT] => $this->discount->getPaymentDiscount(),
        ], JsonResponse::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function getAvailableCodes(): JsonResponse
    {
        return new JsonResponse(
            $this->discount->getAvailableCodes(),
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addCode(Request $request): JsonResponse
    {
        $this->discount->addCode($request->all());

        return new JsonResponse([
            'status' => 'OK'
        ], JsonResponse::HTTP_OK);
    }
}
