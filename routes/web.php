<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\StaffProfileController;
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

Route::prefix('/admin')->middleware('adminAccess')->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
	Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
	Route::get('/company-profile', [CompanyProfileController::class, 'index'])->name('admin.company-profile');
	
	/*Staff Profile Routes Start*/
	Route::get('/staff-profile', [StaffProfileController::class, 'index'])->name('admin.staff-profile');
	Route::get('/staff-profile/list', [StaffProfileController::class, 'list'])->name('admin.staff-profile.list');
	Route::post('/staff-profile/store', [StaffProfileController::class, 'store'])->name('admin.staff-profile.store');
	Route::get('/staff-profile/edit/{id}', [StaffProfileController::class, 'edit'])->name('admin.staff-profile.edit');
	Route::delete('/staff-profile/delete/{id}', [StaffProfileController::class, 'destroy'])->name('admin.staff-profile.delete');
	/*Staff Profile Routes End*/

});