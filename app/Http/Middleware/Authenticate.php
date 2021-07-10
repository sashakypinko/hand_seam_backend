<?php

namespace App\Http\Middleware;


use App\Models\Visitor;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()) {
            $userID = $request->get('userID');
            $ip = $request->ip();
            $user = $this->getUserByToken($userID);

            if (!$user) {
                $user = $this->createUser($userID, $ip);
            }

            Auth::loginUsingId($user->id);
        }

        return $next($request);
    }

    /**
     * @param string $userID
     * @return mixed
     */
    private function getUserByToken(string $userID)
    {
        return Visitor::where('token', $userID)->first();
    }

    /**
     * @param string $userID
     * @return mixed
     */
    private function createUser(string $userID, string $ip)
    {
        return Visitor::create(['token' => $userID, 'ip' => $ip]);
    }
}
