<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Lucas',
            'email' => 'lucas@gmail.com',
            'password' => bcrypt('admin'),
            'isAdmin' => 1,

        ]);
    }
}
