<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{

    public const STATUS_ACCEPTED = 1;
    public const STATUS_NOT_ACCEPTED = 0;

    protected $fillable = [
        'client_id',
        'text',
        'photo',
        'accepted'
    ];
}
