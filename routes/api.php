<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{TodoListController, TransactionController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::group(['prefix' => 'list', 'middleware' => 'api.request.response.logger'], function(){
	Route::post('create', [TodoListController::class, 'store']);
	Route::get('all', [TodoListController::class, 'fetch']);
	Route::put('update', [TodoListController::class, 'update']);
	Route::delete('delete/{id}', [TodoListController::class, 'delete']);
});

Route::group(['prefix' => 'transaction'], function(){
	Route::get('all', [TransactionController::class, 'fetch']);
	Route::post('search', [TransactionController::class, 'search']);
});


