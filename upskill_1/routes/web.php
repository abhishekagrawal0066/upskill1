<?php
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// //google login
// Route::get('login/google', [App\Http\Controllers\Auth\ProviderController::class, 'redirectToGoogle'])->name('login.google');
// Route::get('login/google/callback',  [App\Http\Controllers\Auth\ProviderController::class, 'handleGoogleCallback']);

// // //facebook
Route::get('login/{provider}', [ProviderController::class, 'redirect']);
Route::get('login/{provider}/callback',  [ProviderController::class, 'callback']);
// Route::get('login/facebook', [App\Http\Controllers\Auth\ProviderController::class, 'redirectToFacebook'])->name('login.facebook');
// Route::get('login/facebook/callback',  [App\Http\Controllers\Auth\ProviderController::class, 'handleFacebookCallback']);

// //Github
// Route::get('login/github', [App\Http\Controllers\Auth\ProviderController::class, 'redirectToGithub'])->name('login.github');
// Route::get('login/github/callback',  [App\Http\Controllers\Auth\ProviderController::class, 'handleGithubCallback']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//admin login
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

require __DIR__.'/adminauth.php';
//companies
Route::get('admin/companies/list', [CompaniesController::class, 'index'])->name('companies.list');
Route::get('admin/companies/add', [CompaniesController::class, 'create'])->name('companies.add');
Route::post('admin/companies/add', [CompaniesController::class, 'store']);
Route::any('admin/companies/edit/{id}',[CompaniesController::class, 'edit'])->name('companies.edit');;
Route::any('admin/companies/update/{id}',[CompaniesController::class, 'update'])->name('companies.update');;
Route::any('admin/companies/destroy/{id}',[CompaniesController::class, 'destroy'])->name('companies.destroy');;
//employee
Route::get('admin/employee/list',[EmployeeController::class, 'index'])->name('employee.list');
Route::get('admin/employee/add',[EmployeeController::class, 'create'])->name('employee.add');
Route::post('admin/employee/add',[EmployeeController::class, 'store']);
