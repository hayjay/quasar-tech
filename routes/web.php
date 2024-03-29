<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/gomedia_test');
    return view('welcome');
});

Route::post('login', [AuthController::class, 'authenticate']);
Route::get('logout', [AuthController::class, 'logOut']);


// Route::get('example', array('middleware' => 'cors', 'uses' => 'ExampleController@dummy'));
