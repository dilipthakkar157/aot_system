<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageCompanyProfileController;
use App\Http\Controllers\Admin\ManageStaffProfileController;
use App\Http\Controllers\CommonClassController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyDashboardController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/composer/update', function () {
    Artisan::call('composer:update');
    return redirect('/');
});

Route::get('/optimize', function () {
    Artisan::call('optimize');
    return redirect('/company');
});

Route::get('/company', [CompanyController::class, 'create'])->name('company');
Route::post('/add-company', [CompanyController::class, 'store'])->name('add-company');
Route::get('/company/reset-password', [CompanyController::class, 'resetPassword'])->name('company.reset-password');
Route::post('/company/update-password', [CompanyController::class, 'updatePassword'])->name('company.update-password');
Route::get('/login', [CommonClassController::class, 'login'])->name('common.login');
Route::post('/do-login', [CommonClassController::class, 'doLogin'])->name('common.do-login');

Route::get('/get-countries', [CommonClassController::class, 'getCounties'])->name('get-countries');
Route::get('/get-states/{country_id}', [CommonClassController::class, 'getStates'])->name('get-states');
Route::get('/get-cities/{state_id}', [CommonClassController::class, 'getCities'])->name('get-cities');

Route::get('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/do-login', [LoginController::class, 'doLogin'])->name('admin.do-login');

Route::prefix('/admin')->middleware('adminAccess')->group(function () {
	
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
	Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

	/*Company Profile Start*/	
	Route::get('/company-profile', [ManageCompanyProfileController::class, 'index'])->name('admin.company-profile');
	Route::get('/company-profile/list', [ManageCompanyProfileController::class, 'list'])->name('admin.company-profile.list');
	Route::get('/company-profile/edit/{id}', [ManageCompanyProfileController::class, 'edit'])->name('admin.company-profile.edit');
	Route::post('/company-profile/update', [ManageCompanyProfileController::class, 'update'])->name('admin.company-profile.update');
	Route::delete('/company-profile/delete/{id}', [ManageCompanyProfileController::class, 'destroy'])->name('admin.company-profile.delete');
	/*Company Profile End*/

	/*Staff Profile Routes Start*/
	Route::get('/staff-profile', [ManageStaffProfileController::class, 'index'])->name('admin.staff-profile');
	Route::get('/staff-profile/list', [ManageStaffProfileController::class, 'list'])->name('admin.staff-profile.list');
	Route::post('/staff-profile/store', [ManageStaffProfileController::class, 'store'])->name('admin.staff-profile.store');
	Route::get('/staff-profile/edit/{id}', [ManageStaffProfileController::class, 'edit'])->name('admin.staff-profile.edit');
	Route::delete('/staff-profile/delete/{id}', [ManageStaffProfileController::class, 'destroy'])->name('admin.staff-profile.delete');
	/*Staff Profile Routes End*/

});

Route::prefix('/company')->middleware('companyAccess')->group(function () {
	Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('comapany.dashboard');
	Route::get('/logout', [CompanyController::class, 'companyProfileLogout'])->name('company.logout');
	Route::get('/profile/edit', [CompanyDashboardController::class, 'editProfile'])->name('comapany.profile.edit');
	Route::post('/profile/update', [CompanyDashboardController::class, 'updateProfile'])->name('comapany.profile.update');
	Route::post('/change_password', [CompanyDashboardController::class, 'changePassword'])->name('change_password');
});