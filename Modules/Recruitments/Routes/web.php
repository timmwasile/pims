<?php

use Illuminate\Support\Facades\Route;
use Modules\Admins\Http\Controllers\AdminController;
use Modules\Admins\Http\Controllers\Auth\LoginController;
use Modules\Admins\Http\Controllers\Auth\RegisterController;
use Modules\Admins\Http\Controllers\CompanyController;
use Modules\Recruitments\Http\Controllers\EmployeeController;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Http\Controllers\CustomerController;
use Modules\Recruitments\Http\Controllers\FarmAssetController;
use Modules\Recruitments\Http\Controllers\FarmController;
use Modules\Recruitments\Http\Controllers\GenderController;
use Modules\Recruitments\Http\Controllers\MarketingOfficerController;
use Modules\Recruitments\Http\Controllers\OfficeController;
use Modules\Recruitments\Http\Controllers\PaymentController;
use Modules\Recruitments\Http\Controllers\PermissionController;
use Modules\Recruitments\Http\Controllers\PlotController;
use Modules\Recruitments\Http\Controllers\ProjectController;
use Modules\Recruitments\Http\Controllers\RoleController;
use Modules\Recruitments\Http\Controllers\TransactionController;

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::get('/register/admin', [RegisterController::class, 'showAdminRegistrationForm'])->name('admin.register');
Route::post('/login/admin', [LoginController::class, 'adminLogin'])->name('login');
Route::post('/register/admin', [RegisterController::class, 'adminRegister']);

/*
 |-------------------------------
 |
 | Backend Recruitment Routes
 |
 |-------------------------------
 */
// Auth::routes();
// Route::middleware('auth')->group(function () {
Route::middleware('auth:admin')->name('admin.')->prefix('admin')->group(function () {
// Route::get('/', [AdminController::class, 'index'])->name('home');
    //    CLear plot Amount
    Route::get('/plots/{plot}/transaction/', [PlotController::class, 'transaction'])->name('plots.transaction');
    Route::get('/farm_assets/{plot}/transaction/', [FarmAssetController::class, 'transaction'])->name('farm_assets.transaction');

    Route::post('/plots/{plot}/clear_balance/', [PlotController::class, 'save_to_clear_balance'])->name('plots.save_to_clear_balance');
    Route::post('/farm_assets/{plot}/clear_balance/', [FarmAssetController::class, 'save_to_clear_balance'])->name('farm_assets.save_to_clear_balance');
// upload attachment
     Route::post('plots/media', [PlotController::class, 'storeMedia'])->name('plots.storeMedia');
    Route::post('plots/ckmedia', [PlotController::class, 'storeCKEditorImages'])->name('plots.storeCKEditorImages');

    Route::post('farm_assets/media', [FarmAssetController::class, 'storeMedia'])->name('farm_assets.storeMedia');
    Route::post('farm_assets/ckmedia', [FarmAssetController::class, 'storeCKEditorImages'])->name('farm_assets.storeCKEditorImages');


    // upload office logo
     Route::post('companies/media', [CompanyController::class, 'storeMedia'])->name('companies.storeMedia');
    Route::post('companies/ckmedia', [CompanyController::class, 'storeCKEditorImages'])->name('companies.storeCKEditorImages');


    // print Plot Payment Summary
    Route::get('plot/{plot}/print', [PlotController::class, 'print'])->name('plots.print');
    Route::get('farm_assets/{plot}/print', [FarmAssetController::class, 'print'])->name('farm_assets.print');

    // Transaction Report
    Route::get('transaction/report', [TransactionController::class, 'get_report_form'])->name('transactions.reports.index');
// print Transaction report based on dates
    Route::post('transaction/report/print', [TransactionController::class, 'transaction_report_print'])->name('transactions.reports.print');


    Route::resources([
        'permissions'              => PermissionController::class,
        'roles'                     => RoleController::class,
        'employees'                 =>      EmployeeController::class,
        'offices'                  =>       OfficeController::class,
        'genders'                  =>       GenderController::class,
        'transactions'                  =>       TransactionController::class,
        'projects'                  =>       ProjectController::class,
        'payments'                  =>       PaymentController::class,
        'customers'                  =>       CustomerController::class,
        'marketing_officers'                  =>       MarketingOfficerController::class,
        'plots'                  =>       PlotController::class,
        'farms'                  =>       FarmController::class,
        'farm_assets'                  =>       FarmAssetController::class,

    ]);

    Route::post('/{admin}', [AdminController::class, 'passwordReset'])->name('admins.passwordReset');
});
// });

