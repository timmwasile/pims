<?php
use Illuminate\Support\Facades\Route;
use Modules\Admins\Http\Controllers\AdminController;
use Modules\Admins\Http\Controllers\AuditLogController;
use Modules\Admins\Http\Controllers\HomeController;
use Modules\Admins\Http\Controllers\Auth\LoginController;
use Modules\Admins\Http\Controllers\Auth\RegisterController;
use Modules\Admins\Http\Controllers\CompanyController;
use Modules\Admins\Http\Controllers\LicenseController;
use Modules\Admins\Http\Controllers\UserController;
use Modules\Hrm\Http\Controllers\EmployeeController;
use Modules\Hrm\Http\Controllers\OfficeController;

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::get('/register/admin', [RegisterController::class, 'showAdminRegistrationForm'])->name('admin.register');
Route::post('/login/admin', [LoginController::class, 'adminLogin']);
Route::post('/register/admin', [RegisterController::class, 'adminRegister']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// SMS-Notification
Route::get('send-sms-notification', [AdminController::class, 'sendSmsNotificaition']);


    Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');



        });
    Route::middleware('auth:admin','LicenseCheckMiddleware')->name('admin.')->prefix('admin')->group(function () {
// profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admins.profile');

    // update profile requests
    Route::post('/profile', [AdminController::class, 'update_profile'])->name('admins.update_profile');

    Route::resources([
        'admins'       => AdminController::class,
        'companies'       => CompanyController::class,
        'licenses'       => LicenseController::class,
        'users'        => UserController::class,
        'auditlogs'    => AuditLogController::class,
    ]);
});

