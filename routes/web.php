<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

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
    return redirect('admin/home');
});
Route::get('admin/login', [HomeController::class, 'login'])->name('login');
Route::post('admin/postlogin', [HomeController::class, 'postlogin']);
Route::group(['middleware' => ['auth', 'checkRole:1']], function () {
    Route::get('admin/home', [HomeController::class, 'index'])->name('home');
});
