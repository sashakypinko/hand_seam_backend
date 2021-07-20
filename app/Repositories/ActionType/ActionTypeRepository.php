<?php

namespace App\Repositories\ActionType;

interface ActionTypeRepository
{

    /**
     * @param string $type
     * @return mixed
     */
    public function byType(string $type);
}
