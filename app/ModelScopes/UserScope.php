<?php

namespace App\ModelScopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $table = $model->getTable();

        $builder->where("$table.visitor_id", auth()->id());
    }
}
