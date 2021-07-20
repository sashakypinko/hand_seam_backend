<?php

namespace App\Repositories\Client;

interface ClientRepository
{

    /**
     * @return mixed
     */
    public function get();

    /**
     * @param string $language
     * @return mixed
     */
    public function updateLanguage(string $language);
}
