<?php

namespace Database\Seeders;

use App\Models\Category;

class CategorySeeder extends BaseSeeder
{

    protected $model = Category::class;

    protected $data = [
        [
            'title' => 'Толстовки',
            'photo' => 'files/category/ijEQvlSbEeMZCccLUxfZeclERIhTEmYCYJh00zF4.png'
        ],
        [
            'title' => 'Футболки',
            'photo' => 'files/category/EUeMfwjTBEfAcF74Ebq2LANyXjy2Qo11qhqXbZPO.png'
        ],
        [
            'title' => 'Худи',
            'photo' => 'files/category/xiluuOTiefrpHDHsjXdGhBADSea3ZytiY2eWbEiC.png'
        ],

    ];
}
