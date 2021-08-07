<?php

use Illuminate\Support\Facades\Route;



// For admin application
Route::prefix('admin')->group(function (){
    Route::get('', [\App\Http\Controllers\FrontendController::class, 'admin'])->where('any', '.*');
});


// For public application
Route::any('/{any}', [\App\Http\Controllers\FrontendController::class, 'app'])
    ->where('any', '^(?!api).*$');



