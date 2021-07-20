<?php

namespace App\Nova\Metrics;

use App\Models\Discount;
use Laravel\Nova\Http\Requests\NovaRequest;

class DiscountCounter extends Counter
{

    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return __('Discount Counter');
    }

    /**
     * Calculate the value of the metric.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Discount::class);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'discounts-count';
    }
}
