<?php

namespace App\Nova;

use App\Models\ProductPhoto;
use App\Models\ProductPhoto as Model;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;

class Photo extends Resource
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
    public static $priority = 2;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'photo'
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

            BelongsTo::make(__('Product'), 'product', Product::class)
            ->display('name'),

            Select::make(__('Type'), 'type')->options(Model::TYPES),

            Image::make(__('Photo'), 'photo')
                ->disk('public')->path((new ProductPhoto)->getFilePath())
        ];
    }
}
