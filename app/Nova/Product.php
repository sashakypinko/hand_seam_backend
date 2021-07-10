<?php

namespace App\Nova;

use App\Models\Product as Model;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Product extends Resource
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
        'name', 'price', 'description'
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

            Image::make(__('Photo'), function ($model) {
                return $model->product_photos[0]['photo'] ?? '';
            })
                ->readonly(),

            Text::make(__('Name'), 'name')->sortable(),

            BelongsTo::make(__('Category'), 'category', Category::class)
                ->display('title'),

            BelongsTo::make(__('Type'), 'type', Type::class)
                ->display('name'),

            BelongsTo::make(__('Color'), 'color', Color::class)
                ->display('name'),

            Number::make(__('Price'), 'price')->sortable(),

            Number::make(__('Old Price'), 'old_price')->sortable(),

            Select::make(__('Gender'), 'gender')->options(Model::GENDERS)
                ->displayUsing(function ($gender) {
                    return Model::GENDERS[$gender];
                }),

            Select::make(__('Status'), 'status')->options(Model::STATUSES)
                ->displayUsing(function ($status) {
                    return Model::STATUSES[$status];
                }),

            Textarea::make(__('Description'), 'description')
                ->alwaysShow(),

            HasMany::make(__('Photos'), 'product_photos', Photo::class),

            BelongsToMany::make(__('Sizes'), 'sizes', Size::class)
                ->display('name'),
        ];
    }
}
