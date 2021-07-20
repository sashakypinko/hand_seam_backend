<?php

namespace App\Nova;

use App\Models\Discount as Model;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Discount extends Resource
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
    public static $priority = 1;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title', 'description'
    ];

    /**
     * @param Request $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make(__('Title'), 'title')
                ->sortable(),

            Text::make(__('Description'), 'description')
                ->hideFromIndex()
                ->sortable(),

            Select::make(__('Trigger'), 'trigger')
                ->options(Model::TRIGGERS)
                ->displayUsing(function ($trigger) {
                    return Model::TRIGGERS[$trigger];
                }),

            DateTime::make(__('Start Date'), 'start_date'),

            DateTime::make(__('End Date'), 'end_date'),

            Number::make(__('Amount'), 'amount')
                ->sortable(),

            Number::make(__('Code Active Days'), 'code_active_days')
                ->sortable(),

            Number::make(__('Available Code Count'), 'available_code_count')
                ->sortable(),

            Select::make(__('Status'), 'status')
                ->options(Model::STATUSES)
                ->displayUsing(function ($status) {
                    return Model::STATUSES[$status];
                }),
        ];
    }
}
