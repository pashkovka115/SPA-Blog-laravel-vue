<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostUserSeeder extends Seeder
{
    public function run()
    {
        $users_ids = array_keys(User::all('id')->keyBy('id')->toArray());
        $posts_ids = array_keys(Post::all('id')->keyBy('id')->toArray());

        $data = [];
        for ($i = 0; $i < count($posts_ids); $i++){
            $post_id = $posts_ids[array_rand($posts_ids)];
            $data[] = [
                'user_id' => $users_ids[array_rand($users_ids)],
                'post_id' => $post_id
            ];
            unset($posts_ids[array_search($post_id, $posts_ids)]);
        }

        DB::table('post_user')->insert($data);
    }
}
