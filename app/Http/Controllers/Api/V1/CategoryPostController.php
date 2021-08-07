<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryPostResourse;
use App\Models\CategoryPost;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    public function index()
    {
        return CategoryPostResourse::collection(CategoryPost::all());
    }


    public function store(Request $request)
    {
        //
    }


    public function show(CategoryPost $category)
    {
        return new CategoryPostResourse($category);
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
