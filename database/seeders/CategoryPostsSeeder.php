<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;


class CategoryPostsSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $categories = [];
        for ($i = 0; $i < 5; $i++) {
            $categories[] = [
                'name' => $faker->unique()->word()
            ];
        }

        DB::table('category_posts')->insert($categories);
    }
}
