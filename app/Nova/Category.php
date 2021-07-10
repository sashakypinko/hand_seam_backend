<?php

namespace App\Nova;

use App\Models\Category as Model;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;

class Category extends Resource
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

            Text::make(__('Title'), 'title')->sortable(),

            Image::make(__('Photo'), 'photo')
                ->disk('public')->path((new Model)->getFilePath())
        ];
    }
}
