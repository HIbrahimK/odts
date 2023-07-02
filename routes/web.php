<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
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

Auth::routes();

Route::group(['middleware' => ['auth', 'permission']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::group(['prefix'=> 'users', 'as' => 'users.'], function(){
        Route::resource('permissions', PermissionsController::class);
        Route::resource('roles', RolesController::class);
    });
    Route::resource('users', UsersController::class);
    Route::resource('schools', \App\Http\Controllers\SchoolsController::class);
    Route::resource('levels', \App\Http\Controllers\LevelController::class);
    Route::resource('students', \App\Http\Controllers\StudentController::class);
    Route::resource('lessons', \App\Http\Controllers\LessonController::class);
    Route::resource('tests', \App\Http\Controllers\TestController::class);
    Route::resource('results', \App\Http\Controllers\ResultController::class);
    Route::post('students.import', [\App\Http\Controllers\StudentController::class, 'import'])->name('students.import');
    Route::post('results.import', [\App\Http\Controllers\ResultController::class, 'import'])->name('results.import');

});
Route::post('api/fetch-state',[RegisterController::class,'fatchState']);
Route::post('api/fetch-cities',[RegisterController::class,'fatchCity']);
