<?php


use App\Http\Controllers\Api\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('categories', [\App\Http\Controllers\Api\V1\CategoryPostController::class, 'index']);
Route::get('categories/{category}', [\App\Http\Controllers\Api\V1\CategoryPostController::class, 'show']);

Route::get('articles', [\App\Http\Controllers\Api\V1\PostController::class, 'index']);
Route::get('articles/{article}', [\App\Http\Controllers\Api\V1\PostController::class, 'show']);

Route::get('tags', [\App\Http\Controllers\Api\V1\TagController::class, 'index']);
Route::get('tags/{tag}', [\App\Http\Controllers\Api\V1\TagController::class, 'show']);


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('feed', [\App\Http\Controllers\Api\V1\FeedController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', [AuthController::class, 'getAuthUser']);
    Route::put('/user', [\App\Http\Controllers\Api\V1\UserController::class, 'update']);

    Route::delete('articles/{article}/', [\App\Http\Controllers\Api\V1\PostController::class, 'destroy']);
    Route::post('articles', [\App\Http\Controllers\Api\V1\PostController::class, 'store']);
    Route::put('articles/{article}/edit', [\App\Http\Controllers\Api\V1\PostController::class, 'update']);

    Route::get('post/{id}/isliked', [\App\Http\Controllers\Api\V1\PostController::class, 'isLiked']);
    Route::post('post/{id}/like', [\App\Http\Controllers\Api\V1\PostController::class, 'like']);
});



/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
