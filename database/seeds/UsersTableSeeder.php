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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        App\User::truncate();
        factory('App\User', 10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
