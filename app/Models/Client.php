<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static get()
 */
class Client extends Authenticatable
{

    use Notifiable;

    public const LANGUAGE_UA = 'ua';
    public const LANGUAGE_RU = 'ru';
    public const LANGUAGE_EN = 'en';

    /**
     * @var string[]
     */
    protected $fillable = [
        'token',
        'ip',
        'first_name',
        'last_name',
        'email',
        'number',
        'city',
        'postal_number',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}
