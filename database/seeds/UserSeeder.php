<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'sashakypinko@gmail.com',
            'password' => '$2a$09$H0dYyhuh7vjQD5Vnow/eEeZ0LNgAJ/VjT9N2YbGN3ki9i9K9IeU1u'
        ]);
    }
}
