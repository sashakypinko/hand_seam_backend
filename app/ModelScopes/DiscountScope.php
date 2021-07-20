<?php

namespace App\ModelScopes;

use App\Facades\Client;
use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class DiscountScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $table = $model->getTable();

        $dateNow = Carbon::now();

        $builder->whereDoesntHave('codes', function ($query) {
            $query->where('client_id', Client::id());
        })
            ->where("$table.start_date", '<', $dateNow)
            ->where("$table.end_date", '>', $dateNow)
            ->where("$table.status", Discount::STATUS_ACTIVE);
    }
}
