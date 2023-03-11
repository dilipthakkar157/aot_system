<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommonClassController;
use App\Http\Controllers\StaffDashboardController;
// use App\Http\Controllers\Admin\LoginController;
// use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Admin\ManageCompanyProfileController;
// use App\Http\Controllers\Admin\ManageStaffRolePermissionController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\StaffController;
use App\Http\Controllers\Company\CustomerController;
use App\Http\Controllers\Company\CompanyDashboardController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\Customer\CustomerDashboardController;
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

/*Common Routes - START*/
Route::get('/login', [CommonClassController::class, 'login'])->name('common.login');
Route::post('/do-login', [CommonClassController::class, 'doLogin'])->name('common.do-login');
Route::get('/do-logout', [CommonClassController::class, 'doLogout'])->name('common.logout');
Route::get('/forgotpassword', [CommonClassController::class, 'forgotPassword'])->name('common.forgotpassword');
Route::post('/do-forgotpassword', [CommonClassController::class, 'doForgotpassword'])->name('common.do-forgotpassword');
Route::get('/get-countries', [CommonClassController::class, 'getCounties'])->name('get-countries');
Route::get('/get-states/{country_id}', [CommonClassController::class, 'getStates'])->name('get-states');
Route::get('/get-cities/{state_id}', [CommonClassController::class, 'getCities'])->name('get-cities');
Route::get('/get-roles', [CommonClassController::class, 'getRoles'])->name('get-roles');
Route::get('/get-permissions/{role_id}', [CommonClassController::class, 'getPermissions'])->name('get-permissions');
Route::get('/reset-password', [CommonClassController::class, 'resetPassword'])->name('common.reset-password');
Route::post('/update-password', [CommonClassController::class, 'updatePassword'])->name('common.update-password');
Route::post('/change-password', [CommonClassController::class, 'changePassword'])->name('common.change_password');
/*Common Routes - END*/

/*Route::get('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/do-login', [LoginController::class, 'doLogin'])->name('admin.do-login');

Route::prefix('/admin')->middleware('adminAccess')->group(function () {
	
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
	Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

	Route::get('/company-profile', [ManageCompanyProfileController::class, 'index'])->name('admin.company-profile');
	Route::get('/company-profile/list', [ManageCompanyProfileController::class, 'list'])->name('admin.company-profile.list');
	Route::get('/company-profile/edit/{id}', [ManageCompanyProfileController::class, 'edit'])->name('admin.company-profile.edit');
	Route::post('/company-profile/update', [ManageCompanyProfileController::class, 'update'])->name('admin.company-profile.update');
	Route::delete('/company-profile/delete/{id}', [ManageCompanyProfileController::class, 'destroy'])->name('admin.company-profile.delete');

	Route::get('/staff-role-permission', [ManageStaffRolePermissionController::class, 'index'])->name('admin.staff-role-permission');
	Route::get('/staff-role-permission/list', [ManageStaffRolePermissionController::class, 'list'])->name('admin.staff-role-permission.list');
	Route::post('/staff-role-permission/store', [ManageStaffRolePermissionController::class, 'store'])->name('admin.staff-role-permission.store');
	Route::get('/staff-role-permission/edit/{id}', [ManageStaffRolePermissionController::class, 'edit'])->name('admin.staff-role-permission.edit');
	Route::delete('/staff-role-permission/delete/{id}', [ManageStaffRolePermissionController::class, 'destroy'])->name('admin.staff-role-permission.delete');

});*/

Route::get('/company', [CompanyController::class, 'create'])->name('company');
Route::post('/add-company', [CompanyController::class, 'store'])->name('add-company');

Route::prefix('/company')->middleware('companyAccess')->group(function () {
	Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('comapany.dashboard');
	Route::get('/profile/edit', [CompanyDashboardController::class, 'editProfile'])->name('comapany.profile.edit');
	Route::post('/profile/update', [CompanyDashboardController::class, 'updateProfile'])->name('comapany.profile.update');

	Route::get('/staff', [StaffController::class, 'index'])->name('company.staff');
	Route::get('/staff/list', [StaffController::class, 'list'])->name('company.staff.list');
	Route::post('/staff/store', [StaffController::class, 'store'])->name('company.staff.store');
	Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('company.staff.edit');
	Route::delete('/staff/delete/{id}', [StaffController::class, 'destroy'])->name('company.staff.delete');

	Route::get('/customer', [CustomerController::class, 'index'])->name('company.customer');
	Route::get('/customer/list', [CustomerController::class, 'list'])->name('company.customer.list');
	Route::post('/customer/store', [CustomerController::class, 'store'])->name('company.customer.store');
	Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('company.customer.edit');
	Route::delete('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('company.customer.delete');
	
});

Route::prefix('/staff')->middleware('staffAccess')->group(function () {
	Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
	Route::get('/edit_profile', [StaffDashboardController::class, 'editProfile'])->name('staff.edit_profile');	
	Route::post('/update', [StaffDashboardController::class, 'updateStaff'])->name('staff.update');
});

Route::get('/customer', [CustomerProfileController::class, 'registration'])->name('customer.register');
Route::post('/customer/add-customer', [CustomerProfileController::class, 'doRegistration'])->name('customer.add-customer');

Route::prefix('/customer')->middleware('customerAccess')->group(function () {
	Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
});