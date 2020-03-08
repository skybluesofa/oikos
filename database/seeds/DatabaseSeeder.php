<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(JournalsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(FollowersTableSeeder::class);
    }
}
