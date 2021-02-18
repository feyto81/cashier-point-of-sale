<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SupplierController;

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
Route::get('admin/logout', [HomeController::class, 'logout']);
Route::group(['middleware' => ['auth', 'checkRole:1']], function () {
    Route::get('admin/home', [HomeController::class, 'index'])->name('home');
    Route::get('admin/supplier', [SupplierController::class, 'index']);
    Route::get('admin/supplier/create', [SupplierController::class, 'create']);
    Route::post('admin/supplier/store', [SupplierController::class, 'store']);
    Route::get('admin/supplier/destroy/{supplier_id}', [SupplierController::class, 'destroy']);
    Route::get('admin/supplier/export-excel', [SupplierController::class, 'export_excel']);
    Route::get('admin/supplier/export-pdf', [SupplierController::class, 'export_pdf']);
    Route::post('admin/supplier/import-excel', [SupplierController::class, 'import_excel']);
    Route::get('admin/supplier/edit/{supplier_id}', [SupplierController::class, 'edit']);
    Route::post('admin/supplier/update/{supplier_id}', [SupplierController::class, 'update']);

    Route::get('admin/customer', [CustomerController::class, 'index']);
    Route::get('admin/customer/create', [CustomerController::class, 'create']);
    Route::post('admin/customer/store', [CustomerController::class, 'store']);
    Route::get('admin/customer/destroy/{customer_id}', [CustomerController::class, 'destroy']);
    Route::get('admin/customer/edit/{customer_id}', [CustomerController::class, 'edit']);
    Route::post('admin/customer/update/{customer_id}', [CustomerController::class, 'update']);
    Route::get('admin/customer/export-excel', [CustomerController::class, 'export_excel']);
    Route::get('admin/customer/export-pdf', [CustomerController::class, 'export_pdf']);
    Route::post('admin/customer/import-excel', [CustomerController::class, 'import_excel']);

    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/create', [CategoryController::class, 'create']);
    Route::post('admin/category/store', [CategoryController::class, 'store']);
    Route::get('admin/category/destroy/{category_id}', [CategoryController::class, 'destroy']);
    Route::get('admin/category/edit/{category_id}', [CategoryController::class, 'edit']);
    Route::post('admin/category/update/{category_id}', [CategoryController::class, 'update']);
});
