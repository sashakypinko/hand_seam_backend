<?php

namespace App\Services;

use App\Repositories\ActionType\ActionTypeRepository;
use App\Repositories\Statistic\StatisticRepository;

class Statistic
{

    /**
     * @var StatisticRepository
     */
    private $statistic;

    /**
     * @var ActionTypeRepository
     */
    private $actionType;

    /**
     * Statistic constructor.
     *
     * @param StatisticRepository $statistic
     * @param ActionTypeRepository $actionType
     */
    public function __construct(StatisticRepository $statistic, ActionTypeRepository $actionType)
    {
        $this->actionType = $actionType;
        $this->statistic = $statistic;
    }

    /**
     * @param int $productId
     */
    public function clicked(int $productId)
    {

        $this->statistic->create($productId, $this->getActionTypeId('click'));
    }

    /**
     * @param int $productId
     */
    public function addedToCart(int $productId)
    {
        $this->statistic->create($productId, $this->getActionTypeId('add_to_cart'));
    }

    /**
     * @param int $productId
     */
    public function addedToFavorites(int $productId)
    {
        $this->statistic->create($productId, $this->getActionTypeId('add_to_favorites'));
    }

    /**
     * @param int $productId
     */
    public function paid(int $productId)
    {
        $this->statistic->create($productId, $this->getActionTypeId('paid'));
    }

    /**
     * @param $type
     * @return mixed
     */
    private function getActionTypeId($type)
    {
        return $this->actionType->byType($type)->id ?? false;
    }
}
