<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->command->info('users table seeded');

        $this->call(PostsTableSeeder::class);
        $this->command->info('posts table seeded');

        Model::reguard();
    }
}
