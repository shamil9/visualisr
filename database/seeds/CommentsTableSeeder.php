<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Comment::class, 24)->create(['created_at' => Carbon::now()->subMonths(5)]);
        factory(\App\Comment::class, 16)->create(['created_at' => Carbon::now()->subMonths(4)]);
        factory(\App\Comment::class, 32)->create(['created_at' => Carbon::now()->subMonths(3)]);
        factory(\App\Comment::class, 14)->create(['created_at' => Carbon::now()->subMonths(2)]);
        factory(\App\Comment::class, 28)->create(['created_at' => Carbon::now()->subMonths(1)]);
        factory(\App\Comment::class, 10)->create();
    }
}
