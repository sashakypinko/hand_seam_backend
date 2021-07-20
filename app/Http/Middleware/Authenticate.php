<?php

namespace App\Http\Middleware;

use App\Facades\Client;
use App\Models\Client as Model;
use Closure;

class Authenticate
{

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Client::get()) {
            $userID = $request->get('userID');
            $client = $this->getUserByToken($userID);

            if (!$client) {
                $ip = $request->ip();
                $client = $this->createUser($userID, $ip);
            }

            Client::auth($client);
        }

        return $next($request);
    }

    /**
     * @param string $userID
     * @return mixed
     */
    private function getUserByToken(string $userID)
    {
        return Model::where('token', $userID)->first();
    }

    /**
     * @param string $userID
     * @return mixed
     */
    private function createUser(string $userID, string $ip)
    {
        return Model::create(['token' => $userID, 'ip' => $ip]);
    }
}
