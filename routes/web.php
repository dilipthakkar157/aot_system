<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyProfileController;
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
    return view('welcome');
});


Route::get('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/do-login', [LoginController::class, 'doLogin'])->name('admin.do-login');

Route::middleware('adminAccess')->group(function () {
	Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
	Route::get('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
	Route::get('/admin/company-profile', [CompanyProfileController::class, 'index'])->name('admin.company-profile');
});