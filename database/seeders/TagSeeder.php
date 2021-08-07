<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TagSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $tags = [];
        for ($i = 0; $i < 30; $i++) {
            $name = $faker->unique()->word;
            $tags[] = [
                'name' => ucfirst($name),
                'slug' => Str::slug($name)
            ];
        }

        DB::table('tags')->insert($tags);
    }
}
