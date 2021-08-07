<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\TagWithPostsResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return TagResource::collection(Tag::has('posts')->get());
    }


    public function store(Request $request)
    {

    }


    public function show(Tag $tag)
    {
//        return new TagWithPostsResource($tag);
        return PostResource::collection($tag->posts);
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
