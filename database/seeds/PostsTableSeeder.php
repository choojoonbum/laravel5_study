<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        App\Post::truncate();
        factory('App\Post', 20)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
