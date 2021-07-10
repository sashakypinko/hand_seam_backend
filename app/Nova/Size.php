<?php

namespace App\Nova;

use App\Models\Size as Model;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Size extends Resource
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
        'name'
    ];

    /**
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            Heading::make(__('General Information'))
                ->onlyOnDetail(),

            ID::make()->sortable(),

            Text::make(__('Name'), 'name')->sortable()
        ];
    }
}
