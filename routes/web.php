<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StockInController;
use App\Http\Controllers\Admin\StockOutController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UsersController;

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

    Route::get('admin/unit', [UnitController::class, 'index']);
    Route::get('admin/unit/create', [UnitController::class, 'create']);
    Route::post('admin/unit/store', [UnitController::class, 'store']);
    Route::get('admin/unit/destroy/{category_id}', [UnitController::class, 'destroy']);
    Route::get('admin/unit/edit/{category_id}', [UnitController::class, 'edit']);
    Route::post('admin/unit/update/{category_id}', [UnitController::class, 'update']);

    Route::get('admin/item', [ItemController::class, 'index']);
    Route::get('admin/item/create', [ItemController::class, 'create']);
    Route::post('admin/item/store', [ItemController::class, 'store']);
    Route::get('admin/item/destroy/{item_id}', [ItemController::class, 'destroy']);
    Route::get('admin/item/edit/{item_id}', [ItemController::class, 'edit']);
    Route::post('admin/item/update/{item_id}', [ItemController::class, 'update']);
    Route::get('admin/item/print-barcode-qr-code/{item_id}', [ItemController::class, 'barcodeqrcode']);
    Route::get('admin/item/barcode-print/{item_id}', [ItemController::class, 'print_barcode']);
    Route::get('admin/item/qrcode-print/{item_id}', [ItemController::class, 'print_qrcode']);
    Route::get('admin/item/print-all-barcode', [ItemController::class, 'print_all_barcode']);
    Route::get('admin/item/print-all-qrcode', [ItemController::class, 'print_all_qrcode']);

    Route::get('admin/stock-in', [StockInController::class, 'index']);
    Route::get('admin/stock-in/add', [StockInController::class, 'create']);
    Route::post('admin/stock-in/store', [StockInController::class, 'store']);
    Route::get('admin/stock-in/delete-stock/{stockin_id}', [StockInController::class, 'delete_stock_in']);

    Route::get('admin/stock-out', [StockOutController::class, 'index']);
    Route::get('admin/stock-out/add', [StockOutController::class, 'create']);
    Route::post('admin/stock-out/store', [StockOutController::class, 'store']);
    Route::get('admin/stock-out/delete-stock/{stockout_id}', [StockOutController::class, 'delete_stock_out']);

    Route::get('admin/sales', [TransactionController::class, 'index']);
    Route::post('admin/sales/cart', [TransactionController::class, 'save_cart']);
    Route::get('admin/sales/getDataTable', [TransactionController::class, 'get']);
    Route::get('admin/sales/delete-cart/{cart_id}', [TransactionController::class, 'delete_cart']);
    Route::post('admin/sales/EditData/{cart_id}', [TransactionController::class, 'update']);
    Route::post('admin/sales/transaction', [TransactionController::class, 'kirim_semua']);
    Route::get('admin/sales/cetak/{sale_id}', [TransactionController::class, 'print']);

    Route::get('admin/finance/pengeluaran', [PengeluaranController::class, 'index']);
    Route::post('admin/pengeluaran/add', [PengeluaranController::class, 'create']);
    Route::get('pengeluaran/delete-pengeluaran/{pengeluaran_id}', [PengeluaranController::class, 'destroy']);
    Route::get('pengeluaran/edit-pengeluaran/{pengeluaran_id}', [PengeluaranController::class, 'edit_pengeluaran']);
    Route::post('pengeluaran/update-pengeluaran/{pengeluaran_id}', [PengeluaranController::class, 'update_pengeluaran']);
    Route::get('admin/pengeluaran/export-excel', [PengeluaranController::class, 'export_excel']);
    Route::get('admin/pengeluaran/export-pdf', [PengeluaranController::class, 'export_pdf']);
    Route::get('admin/finance/akumulasi', [KeuanganController::class, 'index']);

    Route::get('admin/report/day', [ReportController::class, 'day']);
    Route::get('admin/report/day/search', [ReportController::class, 'day_search']);
    Route::get('admin/report/sale/dayp', [ReportController::class, 'day_p']);
    Route::get('admin/report/sale/cetakpdf', [ReportController::class, 'day_pdf']);

    Route::get('admin/report/month', [ReportController::class, 'month']);
    Route::get('admin/report/sale/month', [ReportController::class, 'month_search']);
    Route::get('admin/report/sale/monthp', [ReportController::class, 'month_p']);
    Route::get('admin/report/sale/cetakmonthpdf', [ReportController::class, 'month_pdf']);

    Route::get('admin/report/year', [ReportController::class, 'year']);
    Route::get('admin/report/sale/year', [ReportController::class, 'year_search']);
    Route::get('admin/report/sale/yearp', [ReportController::class, 'year_p']);
    Route::get('admin/report/sale/cetakyearpdf', [ReportController::class, 'year_pdf']);

    Route::get('admin/users', [UsersController::class, 'index']);
    Route::post('admin/users/add', [UsersController::class, 'create']);
    Route::get('admin/users/edit-user/{id}', [UsersController::class, 'edit']);
    Route::post('admin/users/update-user/{id}', [UsersController::class, 'update']);
    Route::get('admin/users/delete/{id}', [UsersController::class, 'destroy']);

    Route::get('admin/profile', [ProfileController::class, 'index']);
    Route::put('admin/update-password', [ProfileController::class, 'updatepassword']);
    Route::post('admin/update-profile', [ProfileController::class, 'updateProfile']);
});
