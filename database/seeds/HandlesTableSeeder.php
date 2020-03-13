<?php

use Illuminate\Database\Seeder;

class HandlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Handle::class, 500)->create();
    }
}
