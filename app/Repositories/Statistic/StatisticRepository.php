<?php

namespace App\Repositories\Statistic;

interface StatisticRepository
{

    /**
     * @param int $productId
     * @param int $actionTypeId
     * @return mixed
     */
    public function create(int $productId, int $actionTypeId);

}
