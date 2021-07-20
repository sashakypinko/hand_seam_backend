<?php

namespace App\Nova;

use App\Models\Client as Model;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Client extends Resource
{

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
        'title'
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

            Text::make(__('First Name'), 'first_name')->sortable(),

            Text::make(__('Last Name'), 'last_name')->sortable(),

            Text::make(__('Phone Number'), 'number')->sortable(),

            Text::make(__('IP Address'), 'ip')->sortable(),
        ];
    }
}
