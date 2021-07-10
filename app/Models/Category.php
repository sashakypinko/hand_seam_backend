<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use FileTrait;

    protected $fillable = [
        'title',
        'photo'
    ];
}
