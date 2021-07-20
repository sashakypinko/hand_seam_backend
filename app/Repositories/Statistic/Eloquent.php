<?php

namespace App\Repositories\Statistic;

use App\Facades\Client;
use App\Models\Statistic;

class Eloquent implements StatisticRepository
{

    /**
     * @var Statistic
     */
    private $model;

    /**
     * Eloquent constructor.
     * @param Statistic $model
     */
    public function __construct(Statistic $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $productId
     * @param int $actionTypeId
     * @return mixed|void
     */
    public function create(int $productId, int $actionTypeId)
    {
        $this->model->create([
            'client_id' => Client::id(),
            'product_id' => $productId,
            'action_type_id' => $actionTypeId
        ]);
    }
}
