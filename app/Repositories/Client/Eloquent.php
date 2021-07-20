<?php

namespace App\Repositories\Client;

use App\Facades\Client;
use App\Models\Client as Model;

class Eloquent implements ClientRepository
{

    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->model->all();
    }

    /**
     * @param string $language
     * @return mixed
     */
    public function updateLanguage(string $language)
    {
        $client = Client::get();
        $client->language = $language;
        $client->save();
    }
}
