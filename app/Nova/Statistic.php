<?php

namespace App\Nova;

use App\Models\Statistic as Model;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;

class Statistic extends Resource
{

    use FileTrait;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Model::class;

    /**
     * The sorting resource priority
     *
     * @var int
     */
    public static $priority = 3;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        //
    ];

    /**
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make(__('Client'), 'client', Client::class)
                ->display(function ($client) {
                    return "$client->first_name $client->last_name, $client->number, $client->ip";
                }),

            BelongsTo::make(__('Product'), 'product', Product::class)
                ->display('name'),

            BelongsTo::make(__('Action Type'), 'actionType', ActionType::class)
                ->display('type')
        ];
    }
}
