<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Visitor extends Authenticatable
{

    use Notifiable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'token',
        'ip'
    ];

}
