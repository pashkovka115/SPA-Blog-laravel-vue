<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeedResource;
use App\Http\Resources\PostResource;
use App\Models\Feed;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;


class FeedController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $posts_ids = array_keys(Feed::where('user_id', auth()->id())->get()->keyBy('post_id')->toArray());
            $posts = Post::whereIn('id', $posts_ids)->paginate(6);

            return FeedResource::collection($posts);
        }
        return PostResource::collection([]);
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
