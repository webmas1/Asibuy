<?php

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
        factory(App\User::class, 10)->create();
        DB::table('users')->insert([
            'first_name' => 'Pol',
            'last_name' => 'Bogopolsky',
            'email' => 'pol292@gmail.com',
            'password' => '$2y$10$0FP.p1xsnEC4b6wdAqcctuTXsL0Rg3nB/RHsHPtS1Ls29wNWzyRwi',
            'role' => 2,
            'status' => 1,
            'created_at' => '2019-12-16 05:06:51',
            'updated_at' => '2019-12-16 05:06:51'
        ]);
        DB::table('users')->insert([
            'first_name' => 'Asi',
            'last_name' => 'Kapner',
            'email' => 'webmas1@gmail.com',
            'password' => '$2y$10$0FP.p1xsnEC4b6wdAqcctuTXsL0Rg3nB/RHsHPtS1Ls29wNWzyRwi',
            'role' => 1,
            'status' => 1,
            'created_at' => '2019-12-16 05:06:51',
            'updated_at' => '2019-12-16 05:06:51'
        ]);
    }
}
