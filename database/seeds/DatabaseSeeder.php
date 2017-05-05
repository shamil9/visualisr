<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Redis;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Redis::flushall();
        $this->call(UsersTableSeeder::class);
        $this->call(VisualsTableSeeder::class);
        $this->call(BlogTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
