<?php

namespace App\Repositories\ActionType;

use App\Models\ActionType;

class Eloquent implements ActionTypeRepository
{

    /**
     * @var ActionType
     */
    private $model;

    /**
     * Eloquent constructor.
     *
     * @param ActionType $model
     */
    public function __construct(ActionType $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function byType(string $type)
    {
        return $this->model->whereType($type)->first();
    }
}
