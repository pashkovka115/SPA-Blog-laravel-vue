<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PostsSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $posts = [];
        $max_id = max(CategoryPost::all('id')->toArray())['id'];
        $max_user_id = max(User::all('id')->toArray())['id'];
        $imgs = [
            '/assets/app/img/priroda11.jpg',
            '/assets/app/img/priroda22.jpg',
            '/assets/app/img/priroda33.jpg',
            '/assets/app/img/priroda44.jpg',
            '/assets/app/img/priroda55.jpg',
        ];

        for ($i = 0; $i < 100; $i++) {
            $name = ucfirst($faker->sentence());
            $posts[] = [
                'user_id' => random_int(1, $max_user_id),
                'category_post_id' => random_int(1, $max_id),
                'name' => $name,
                'slug' => Str::slug($name),
                'img' => $imgs[array_rand($imgs)],
                'description' => $faker->paragraphs(3, true),
                'created_at' => $faker->dateTimeBetween()
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
