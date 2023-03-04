<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageCompanyProfileController;
use App\Http\Controllers\Admin\ManageStaffRolePermissionController;
use App\Http\Controllers\CommonClassController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StaffController;
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
Route::get('/staff/reset-password', [StaffController::class, 'resetPassword'])->name('staff.reset-password');
Route::post('/staff/update-password', [StaffController::class, 'updatePassword'])->name('staff.update-password');

/*Common Routes - START*/
Route::get('/login', [CommonClassController::class, 'login'])->name('common.login');
Route::post('/do-login', [CommonClassController::class, 'doLogin'])->name('common.do-login');
Route::get('/forgotpassword', [CommonClassController::class, 'forgotPassword'])->name('common.forgotpassword');
Route::post('/do-forgotpassword', [CommonClassController::class, 'doForgotpassword'])->name('common.do-forgotpassword');

Route::get('/get-countries', [CommonClassController::class, 'getCounties'])->name('get-countries');
Route::get('/get-states/{country_id}', [CommonClassController::class, 'getStates'])->name('get-states');
Route::get('/get-cities/{state_id}', [CommonClassController::class, 'getCities'])->name('get-cities');
Route::get('/get-roles', [CommonClassController::class, 'getRoles'])->name('get-roles');
Route::get('/get-permissions/{role_id}', [CommonClassController::class, 'getPermissions'])->name('get-permissions');
/*Common Routes - END*/

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
	Route::get('/staff-role-permission', [ManageStaffRolePermissionController::class, 'index'])->name('admin.staff-role-permission');
	Route::get('/staff-role-permission/list', [ManageStaffRolePermissionController::class, 'list'])->name('admin.staff-role-permission.list');
	Route::post('/staff-role-permission/store', [ManageStaffRolePermissionController::class, 'store'])->name('admin.staff-role-permission.store');
	Route::get('/staff-role-permission/edit/{id}', [ManageStaffRolePermissionController::class, 'edit'])->name('admin.staff-role-permission.edit');
	Route::delete('/staff-role-permission/delete/{id}', [ManageStaffRolePermissionController::class, 'destroy'])->name('admin.staff-role-permission.delete');
	/*Staff Profile Routes End*/

});

Route::prefix('/company')->middleware('companyAccess')->group(function () {
	Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('comapany.dashboard');
	Route::get('/logout', [CompanyController::class, 'companyProfileLogout'])->name('company.logout');
	Route::get('/profile/edit', [CompanyDashboardController::class, 'editProfile'])->name('comapany.profile.edit');
	Route::post('/profile/update', [CompanyDashboardController::class, 'updateProfile'])->name('comapany.profile.update');
	Route::post('/change_password', [CompanyDashboardController::class, 'changePassword'])->name('change_password');

	Route::get('/staff', [StaffController::class, 'index'])->name('company.staff');
	Route::get('/staff/list', [StaffController::class, 'list'])->name('company.staff.list');
	Route::post('/staff/store', [StaffController::class, 'store'])->name('company.staff.store');
	Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('company.staff.edit');
	Route::delete('/staff/delete/{id}', [StaffController::class, 'destroy'])->name('company.staff.delete');
});

Route::prefix('/staff')->middleware('staffAccess')->group(function () {
	Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
	Route::get('/logout', [StaffDashboardController::class, 'logout'])->name('staff.logout');
	Route::post('/change_password', [StaffDashboardController::class, 'changePassword'])->name('staff.change_password');

});