<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Shamil',
            'email' => 'shamil9@gmail.com',
            'password' => bcrypt('foobar'),
            'remember_token' => str_random(10),
            'admin' => 1,
        ]);
    }
}
