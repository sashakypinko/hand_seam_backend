<?php

namespace App\Services;

use App\Models\Client as ClientModel;

class Client
{

    /**
     * @param ClientModel $client
     */
    public function auth(ClientModel $client)
    {
        session()->put('client', $client);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return session()->get('client');
    }

    public function id()
    {
        return $this->get()->id ?? null;
    }
}
