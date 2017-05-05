<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VisualsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Visual::class, 2)->create(['created_at' => Carbon::now()->subMonths(5)]);
        factory(\App\Visual::class, 7)->create(['created_at' => Carbon::now()->subMonths(4)]);
        factory(\App\Visual::class, 3)->create(['created_at' => Carbon::now()->subMonths(3)]);
        factory(\App\Visual::class, 8)->create(['created_at' => Carbon::now()->subMonths(2)]);
        factory(\App\Visual::class, 4)->create(['created_at' => Carbon::now()->subMonths(1)]);
        factory(\App\Visual::class, 9)->create();
    }
}
