<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagSeeder extends Seeder
{
    public function run()
    {
        $pars = [];
        $tags_ids = array_keys(Tag::all('id')->keyBy('id')->toArray());
        $posts_ids = array_keys(Post::all('id')->keyBy('id')->toArray());

        for ($i = 0; $i < 20; $i++) {
            $flag = true;
            $post_id = $posts_ids[array_rand($posts_ids)];
            $tag_id = $tags_ids[array_rand($tags_ids)];

            foreach ($pars as $el){
                if (($el['post_id'] == $post_id) and ($el['tag_id'] == $tag_id)){
                    $flag = false;
                }
            }

            if ($flag){
                $pars[] = [
                    'post_id' => $post_id,
                    'tag_id' => $tag_id,
                ];
            }
        }

        DB::table('post_tag')->insert($pars);
    }
}
