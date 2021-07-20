<?php

namespace App\Nova\Metrics;

use App\Models\Client;
use Laravel\Nova\Http\Requests\NovaRequest;

class ClientCounter extends Counter
{

    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return __('Client Counter');
    }

    /**
     * Calculate the value of the metric.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Client::class);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'clients-count';
    }
}
