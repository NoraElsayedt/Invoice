<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController ; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\invoices_report;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Customers_Report;
use App\Http\Controllers\InvoicesDetailsController; 
use App\Http\Controllers\InvoicesAttachmentsController; 
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});


Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

Route::resource('invoices', InvoicesController::class);
Route::resource('InvoiceAttachments', InvoicesAttachmentsController::class);
Route::resource('department', SectionsController::class);
Route::resource('category', ProductsController::class);
Route::get('section/{id}',[InvoicesController::class,'getsection']);
Route::get('status/{id}',[InvoicesController::class,'show']);
Route::post('statusupdate/{id}',[InvoicesController::class,'statusupdate']);
Route::get('invoicesdatails/{id}',[InvoicesDetailsController::class,'edit']);
Route::get('View_file/{invoices_number}/{file_name}',[InvoicesDetailsController::class,'open_file']);
Route::get('download/{invoices_number}/{file_name}',[InvoicesDetailsController::class,'download']);
Route::post('delete_file',[InvoicesDetailsController::class,'destroy'])->name('delete_file');
Route::get('edit_envoices/{id}',[InvoicesController::class,'edit']);
Route::get('paidinvoices',[InvoicesController::class,'paidinvoices']);
Route::get('haftinvoices',[InvoicesController::class,'haftinvoices']);
Route::get('unpaidinvoices',[InvoicesController::class,'unpaidinvoices']);
Route::get('archinvoices',[InvoicesController::class,'archinvoices']);
Route::get('print/{id}',[InvoicesController::class,'printinv']);
Route::get('exportinv', [InvoicesController::class, 'export']);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles',RoleController::class);
    Route::resource('users',UserController::class);
    });

    Route::get('invoices_report', [invoices_report::class,'index']);
    Route::post('Search_invoices', [invoices_report::class,'Search_invoices']);
    Route::get('customers_report', [Customers_Report::class,'index']);
    
    Route::post('Search_customers', [Customers_Report::class,'Search_customers']);
Route::get('MarkAsRead_all',[InvoicesController::class, 'MarkAsRead_all']);

Route::get('/{page}',[AdminController::class,'index']);