<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{

    protected $model;

    protected $data;

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $data) {
            $this->model::create($data);
        }
    }
}
