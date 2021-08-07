<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedsSeeder extends Seeder
{
    public function run()
    {
        $feeds = [];
        $users_ids = array_keys(User::all('id')->keyBy('id')->toArray());
        $posts_ids = array_keys(Post::all('id')->keyBy('id')->toArray());

        for ($i = 0; $i < 100; $i++) {
            $flag = true;
            $post_id = $posts_ids[array_rand($posts_ids)];
            $user_id = $users_ids[array_rand($users_ids)];

            foreach ($feeds as $el){
                if (($el['post_id'] == $post_id) and ($el['user_id'] == $user_id)){
                    $flag = false;
                }
            }

            if ($flag){
                $feeds[] = [
                    'post_id' => $post_id,
                    'user_id' => $user_id,
                ];
            }
        }

        DB::table('feeds')->insert($feeds);
    }
}
