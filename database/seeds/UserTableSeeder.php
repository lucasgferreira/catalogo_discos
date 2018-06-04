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
            'email' => 'lucasg_f@outlook.com',
            'password' => bcrypt('1234qwerty'),
            'isAdmin' => 1,
        ]);
    }
}
