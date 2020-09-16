<?php

use App\Http\Controllers\Admin\FoldersController as AdminFoldersController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PermissionsController as AdminPermissionsController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\RolesController as AdminRolesController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Auth\ChangePasswordController as AuthChangePasswordController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/projects');
/*
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});
*/

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::resource('projects', ProjectController::class)->only(['index', 'show']);

    Route::get('folders/upload', [FolderController::class, 'upload'])->name('folders.upload');
    Route::post('folders/media', [FolderController::class, 'storeMedia'])->name('folders.storeMedia');
    Route::post('folders/upload', [FolderController::class, 'postUpload'])->name('folders.postUpload');

    Route::resource('folders', FolderController::class)->except(['index', 'destroy']);
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin'], function () {
        Route::get('/', 'HomeController@index')->name('home');
        // Permissions
        Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
        Route::resource('permissions', 'PermissionsController');

        // Roles
        Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
        Route::resource('roles', 'RolesController');

        // Users
        Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
        Route::resource('users', 'UsersController');

        // Projects
        Route::delete('projects/destroy', 'ProjectsController@massDestroy')->name('projects.massDestroy');
        Route::resource('projects', 'ProjectsController');

        // Folders
        Route::delete('folders/destroy', 'FoldersController@massDestroy')->name('folders.massDestroy');
        Route::post('folders/media', 'FoldersController@storeMedia')->name('folders.storeMedia');
        Route::post('folders/ckmedia', 'FoldersController@storeCKEditorImages')->name('folders.storeCKEditorImages');
        Route::resource('folders', 'FoldersController');
    });
    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'App\Http\Controllers\Auth'], function () {
        // Change password
        if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
            Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
            Route::post('password', 'ChangePasswordController@update')->name('password.update');
        }
    });
});
