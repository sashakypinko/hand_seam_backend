<?php

namespace App\Repositories\Discount;

interface DiscountRepository
{

    /**
     * @return mixed
     */
    public function getVisitDiscount();

    /**
     * @return mixed
     */
    public function getPaymentDiscount();

    /**
     * @return mixed
     */
    public function getAvailableCodes();

    /**
     * @param array $data
     * @return mixed
     */
    public function addCode(array $data);
}
