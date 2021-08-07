<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersSeeder::class);
        $this->call(CategoryPostsSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(PostUserSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(PostTagSeeder::class);
        $this->call(FeedsSeeder::class);
    }
}
