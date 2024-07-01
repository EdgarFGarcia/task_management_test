<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group([
    'prefix' => 'non_auth'
], function(){
    Route::post('/register', [App\Http\Controllers\User\CUsers::class, 'register']);
    Route::post('/login', [App\Http\Controllers\User\CUsers::class, 'login']);
});

/**
 |----------------------------------------------------------------------------------------
 | authenticated tokens below, we can also include token authorization here
 | using laravel sanctum's abilities
 |----------------------------------------------------------------------------------------
 */
Route::group([
    'prefix'        => 'tasks',
    'middleware'    => 'auth:sanctum'
], function(){
    Route::post('/addATask', [App\Http\Controllers\Task\CTasks::class, 'addATask']);
    Route::get('/getTasks/{limit?}', [App\Http\Controllers\Task\CTasks::class, 'getTasks']);
    Route::put('/updateATask/{id?}', [App\Http\Controllers\Task\CTasks::class, 'updateATask']);
});
