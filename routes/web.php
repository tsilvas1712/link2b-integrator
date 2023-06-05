<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Integrador\{
    MainController,
    TenantController,
    CampaignController,
    SaleController,
    ProfileController,
    PermissionController,
    DatasysController,
    Admin\ACL\PermissionProfileController,
};

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

Route::middleware('auth')->group(function () {
    Route::get('/', [MainController::class, 'index']);

    Route::resource('/tenants', TenantController::class);
    Route::resource('/campanhas', CampaignController::class);
    Route::resource('/mensagens', SaleController::class);


    Route::resource('/profiles', ProfileController::class);


    Route::post('profiles/{id}/permissions',[PermissionProfileController::class,'attachPermissionsProfile'])
        ->name('profiles.permissions.attach');
    Route::get('profiles/{id}/permissions/create',[PermissionProfileController::class,'permissionsAvailable'])
        ->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions',[PermissionProfileController::class,'permissions'])
    ->name('profiles.permissions');

    Route::resource('/permissions', PermissionController::class);

    Route::prefix('/datasys')->group(function () {
        Route::get('', [DatasysController::class, 'index']);
    });
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
