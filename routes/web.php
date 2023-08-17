<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SummerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectController;


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
Route::get('login',[CustomLoginController::class,'login']);
Route::post('login-post',[CustomLoginController::class,'loginpost']);
Route::get('dashboard',[AdminController::class,'dashboard']);
Route::get('register',[CustomLoginController::class,'register'])->name('register');
Route::post('register-post',[CustomLoginController::class,'registerpost'])->name('registerpost');
Route::get('logout',[CustomLoginController::class,'signout']);
Route::get('summer',[SummerController::class,'summer']);
Route::get('searchuser',[UserController::class,'searchuser']);
Route::get('searchrole',[RoleController::class,'searchrole']);
Route::get('searchproject',[ProjectController::class,'searchproject']);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('userlist',UserController::class);
    Route::resource('rolelist', RoleController::class);
    Route::resource('permissionlist',PermissionController::class);
    Route::resource('projectlist',ProjectController::class);
    //Route::delete('/permissionlist/{id}', [PermissionController::class,'destroy']);


});
