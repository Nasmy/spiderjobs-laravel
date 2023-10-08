<?php

use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\JobCategoryController;
use App\Services\AuthService;
use App\Services\UserService;
use App\Services\RoleService;
use App\Services\PermissionService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

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


/** Job portal routes with authentication **/
Route::group([
    'middleware' => ['guest'],
], function () {
    Route::get('/', function () {
        return redirect('login');
    });
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

});

Route::get('/jobs/{applyUrl}/apply', [JobApplicationController::class, 'showApplyForm'])->name('job-apply-form');
Route::post('/jobs/{applyUrl}/apply', [JobApplicationController::class, 'store'])->name('job-apply-store');
Route::get('jobs/open', [JobController::class, 'showOpenJobs'])->name('open-jobs');

Route::middleware([
    'auth',
])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    // Job related routes
    Route::get('job', [JobController::class, 'index'])->name('job');
    Route::get('job/create', [JobController::class, 'create'])->name('job-create');
    Route::get('job/{id}', [JobController::class, 'show'])->name('job-show');
    Route::get('job/{id}/edit', [JobController::class, 'edit'])->name('job-edit');
    Route::put('job/{id}/update', [JobController::class, 'update'])->name('job-update');
    Route::post('job', [JobController::class, 'store'])->name('job-store');
    Route::delete('job/{id}/destroy', [JobController::class, 'destroy'])->name('job-destroy');

    // Job category related route
    Route::resource('job-category', JobCategoryController::class);
    Route::get('job-category', [JobCategoryController::class, 'index'])->name('job-category');
    Route::get('job-category/create', [JobCategoryController::class, 'create'])->name('job-category-create');
    Route::post('job-category', [JobCategoryController::class, 'store'])->name('job-category-store');
    Route::get('job-category/{id}/edit', [JobCategoryController::class, 'edit'])->name('job-category-edit');
    Route::put('job-category/{id}/update', [JobCategoryController::class, 'update'])->name('job-category-update');
    Route::delete('job-category/{id}/destroy', [JobCategoryController::class, 'destroy'])->name('job-category-destroy');

    // Role routes
    Route::get('role', [RoleController::class, 'index'])->name('role')
        ->middleware(AuthService::setAuthPermissions(RoleService::PERMISSION_PARENT, PermissionService::PERMISSION_VIEW));
    Route::get('role/create', [RoleController::class, 'create'])->name('role-create')
        ->middleware(AuthService::setAuthPermissions(RoleService::PERMISSION_PARENT, PermissionService::PERMISSION_CREATE));
    Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('role-edit')
        ->middleware(AuthService::setAuthPermissions(RoleService::PERMISSION_PARENT, PermissionService::PERMISSION_EDIT));
    Route::post('role', [RoleController::class, 'store'])->name('role-store')
        ->middleware(AuthService::setAuthPermissions(RoleService::PERMISSION_PARENT, PermissionService::PERMISSION_CREATE));
    Route::put('role/{id}/update', [RoleController::class, 'update'])->name('role-update')
        ->middleware(AuthService::setAuthPermissions(RoleService::PERMISSION_PARENT, PermissionService::PERMISSION_EDIT));
    Route::delete('role/{id}/destroy', [RoleController::class, 'destroy'])->name('role-destroy')
        ->middleware(AuthService::setAuthPermissions(RoleService::PERMISSION_PARENT, PermissionService::PERMISSION_DELETE));

    // User routes
    Route::get('user', [UserController::class, 'index'])->name('user')
        ->middleware(AuthService::setAuthPermissions(UserService::PERMISSION_PARENT, PermissionService::PERMISSION_VIEW));
    Route::get('user/create', [UserController::class, 'create'])
        ->name('user-create')->middleware(AuthService::setAuthPermissions(UserService::PERMISSION_PARENT, PermissionService::PERMISSION_CREATE));
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user-edit')
        ->middleware(AuthService::setAuthPermissions(UserService::PERMISSION_PARENT, PermissionService::PERMISSION_EDIT));
    Route::post('user', [UserController::class, 'store'])->name('user-store')
        ->middleware(AuthService::setAuthPermissions(UserService::PERMISSION_PARENT, PermissionService::PERMISSION_CREATE));
    Route::put('user/{id}/update', [UserController::class, 'update'])->name('user-update')
        ->middleware(AuthService::setAuthPermissions(UserService::PERMISSION_PARENT, PermissionService::PERMISSION_EDIT));
    Route::delete('user/{id}/destroy', [UserController::class, 'destroy'])->name('user-destroy')
        ->middleware(AuthService::setAuthPermissions(UserService::PERMISSION_PARENT, PermissionService::PERMISSION_DELETE));

    Route::get('/manage-applications', [JobApplicationController::class, 'index'])->name('manage-applications');
    Route::get('/manage-applications/{id}', [JobApplicationController::class, 'show'])->name('manage-applications-show');
    Route::delete('/manage-applications/{id}/destroy', [JobApplicationController::class, 'destroy'])->name('manage-applications-destroy');
    Route::get('/download-resume/{jobApplicationId}', [JobApplicationController::class, 'downloadResume'])->name('download-resume');

    Route::get('configuration/update', [ConfigurationController::class, 'edit'])->name('configuration-update')
        ->middleware(AuthService::setAuthPermissions());
    Route::post('configuration', [ConfigurationController::class, 'update'])->name('configuration-store')->middleware(AuthService::setAuthPermissions());
});
