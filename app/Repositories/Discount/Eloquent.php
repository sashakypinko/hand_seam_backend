<?php

namespace App\Repositories\Discount;

use App\Facades\Client;
use App\Models\Discount;
use App\Models\DiscountCode;
use Carbon\Carbon;

class Eloquent implements DiscountRepository
{

    /**
     * @var Discount
     */
    private $discountModel;

    /**
     * @var DiscountCode
     */
    private $discountCodeModel;

    /**
     * Eloquent constructor.
     * @param Discount $discountModel
     * @param DiscountCode $discountCodeModel
     */
    public function __construct(Discount $discountModel, DiscountCode $discountCodeModel)
    {
        $this->discountModel = $discountModel;
        $this->discountCodeModel = $discountCodeModel;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDiscountById(int $id)
    {
        return $this->discountModel->find($id);
    }

    /**
     * @return mixed
     */
    public function getPaymentDiscount()
    {
        return $this->discountModel
            ->where('trigger', $this->discountModel::TRIGGER_PAYMENT)
            ->first();
    }

    /**
     * @return mixed
     */
    public function getVisitDiscount()
    {
        return $this->discountModel
            ->where('trigger', $this->discountModel::TRIGGER_VISIT)
            ->first();
    }

    public function getAvailableCodes()
    {
        $codes = $this->discountCodeModel
            ->with('discount')
            ->get();

        return $codes->filter(function ($code) {
            $expirationDate = Carbon::make($code->created_at)->addDays($code->discount->code_active_days);

            return $expirationDate > Carbon::now();
        });
    }

    /**
     * @param array $data
     * @return mixed|void
     */
    public function addCode(array $data)
    {
        $this->discountCodeModel->create([
            'discount_id' => $data['id'],
            'client_id' => Client::id(),
            'code' => $data['code'],
            'status' => $data['accepted']
                ? $this->discountCodeModel::STATUS_ACTIVE
                : $this->discountCodeModel::STATUS_EXPIRED
        ]);

        $this->updateAvailableCodeCount($data['id']);
    }

    /**
     * @param int $id
     */
    private function updateAvailableCodeCount(int $id)
    {
        $discount = $this->discountModel
            ->withoutGlobalScopes()
            ->find($id);

        if ($discount) {
            $discount->available_code_count = $discount->available_code_count - 1;
            $discount->status = $discount->available_code_count > 0
                ? $this->discountModel::STATUS_ACTIVE
                : $this->discountModel::STATUS_INACTIVE;
            $discount->save();
        }
    }
}
