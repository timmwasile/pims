<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Modules\Recruitments\Entities\JobApplication;
use Modules\Recruitments\Entities\Skill;
use Modules\Recruitments\Entities\JobPost;
use Modules\Recruitments\Entities\JobCategory;
use Modules\Recruitments\Http\Controllers\JobApplicationsController;

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
    
//   Route::get('/', [HomeController::class, 'index'])->name('login');
    return view('welcome');
});
    Route::middleware('LicenseCheckMiddleware')->name('admin.')->prefix('admin')->group(function () {
    });

