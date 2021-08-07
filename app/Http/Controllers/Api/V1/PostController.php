<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostListResource;
use App\Http\Resources\PostResource;
use App\Jobs\AddLikeJob;
use App\Jobs\DeleteLikeJob;
use App\Models\CategoryPost;
use App\Models\Like;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return PostListResource::collection(Post::paginate(2));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'tags' => 'nullable|array',
        ]);

        // todo: исправить когда будут категории
        if (!isset($data['category_post_id'])) {
            $cats_ids = array_keys(CategoryPost::all('id')->keyBy('id')->toArray());
            $data['category_post_id'] = $cats_ids[array_rand($cats_ids)];
        }
        //////////////////

        $data['user_id'] = auth()->id();
        $post = Post::create($data);

        if (count($data['tags']) > 0 and !is_null($data['tags'][0])) {
            $tag_names = array_keys(Tag::all('name')->keyBy('name')->toArray());
            $tags = [];
            foreach ($data['tags'] as $tag) {
                $tag = trim($tag);
                if (!in_array($tag, $tag_names)) {
                    $tags[] = Tag::create(['name' => $tag])->id;
                } else {
                    $tags[] = Tag::where('name', $tag)->first('id')->id;
                }
            }

            $post->tags()->attach($tags);
        }

        return new PostResource($post);
    }


    public function show(Post $article)
    {
        return new PostResource($article);
    }


    public function update(Request $request, Post $article)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'tags' => 'nullable|array',
        ]);
        if (isset($data['tags']) and ($data['tags'] == [] or $data['tags'] == [null])) {
            unset($data['tags']);
        }

        $article->update($data);

        if (isset($data['tags'])) {
            $tag_names = array_keys(Tag::all('name')->keyBy('name')->toArray());
            $tags = [];
            foreach ($data['tags'] as $tag) {
                $tag = trim($tag);
                if (!in_array($tag, $tag_names)) {
                    $tags[] = Tag::create(['name' => $tag])->id;
                } else {
                    $tags[] = Tag::where('name', $tag)->first('id')->id;
                }
            }

            $article->tags()->sync($tags);
        }

        return new PostResource($article);
    }


    public function destroy(Post $article)
    {
        $article->delete();

        return response('OK');
    }


    /**
     * @param $id Post
     * @return \Illuminate\Http\JsonResponse
     */
    public function isLiked($id, $json = true)
    {
        if (Like::whereUserId(auth()->id())->wherePostId($id)->exists()) {
            $result = true;
        } else {
            $result = false;
        }

        if ($json) {
            return response()->json([
                'data' => ['result' => "$result"]
            ]);
        }

        return $result;
    }


    /**
     * @param $id Post
     * @return \Illuminate\Http\JsonResponse
     */
    public function like($id)
    {
        if ($this->isLiked($id, false)) {
            DeleteLikeJob::dispatch([
                'post_id' => $id,
                'user_id' => auth()->id()
            ]);

        } else {
            AddLikeJob::dispatch([
                'post_id' => $id,
                'user_id' => auth()->id()
            ]);
        }

        return response()->json([
            'data' => [
                'result' => true,
                'message' => 'Действие передано в очередь задач.',
            ]
        ]);
    }
}
