<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\StaffProfileController;
use App\Http\Controllers\CommonClassController;
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
    // Call the ComposerUpdate command
    Artisan::call('composer:update');

    // Redirect back to the home page or another appropriate page
    return redirect('/');
});

Route::get('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/do-login', [LoginController::class, 'doLogin'])->name('admin.do-login');

Route::get('/get-countries', [CommonClassController::class, 'getCounties'])->name('get-countries');
Route::get('/get-states/{country_id}', [CommonClassController::class, 'getStates'])->name('get-states');
Route::get('/get-cities/{state_id}', [CommonClassController::class, 'getCities'])->name('get-cities');

Route::prefix('/admin')->middleware('adminAccess')->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
	Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
	
	Route::get('/company-profile', [CompanyProfileController::class, 'index'])->name('admin.company-profile');
	Route::get('/company-profile/list', [CompanyProfileController::class, 'list'])->name('admin.company-profile.list');
	Route::get('/company-profile/edit/{id}', [CompanyProfileController::class, 'edit'])->name('admin.staff-profile.edit');
	Route::post('/company-profile/update', [CompanyProfileController::class, 'update'])->name('admin.company-profile.update');
	Route::delete('/company-profile/delete/{id}', [CompanyProfileController::class, 'destroy'])->name('admin.company-profile.delete');

	/*Staff Profile Routes Start*/
	Route::get('/staff-profile', [StaffProfileController::class, 'index'])->name('admin.staff-profile');
	Route::get('/staff-profile/list', [StaffProfileController::class, 'list'])->name('admin.staff-profile.list');
	Route::post('/staff-profile/store', [StaffProfileController::class, 'store'])->name('admin.staff-profile.store');
	Route::get('/staff-profile/edit/{id}', [StaffProfileController::class, 'edit'])->name('admin.staff-profile.edit');
	Route::delete('/staff-profile/delete/{id}', [StaffProfileController::class, 'destroy'])->name('admin.staff-profile.delete');
	/*Staff Profile Routes End*/

});