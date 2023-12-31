<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [LoginController::class, 'index']);

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.tasks', ProjectController::class);
    Route::resource('reports', ReportController::class);

    // Route::group([
    //     'prefix' => 'projects'
    // ], function(){
    //     Route::resource('/', ProjectController::class);p
    //     Route::resource('{id}/tasks', ProjectController::class);

    // });


    Route::get('/projects/{project}/tasks', [ProjectController::class, 'showTasks'])->name('projects.tasks.index');
    Route::get('/projects/{project}/tasks/create', [ProjectController::class, 'createTasks'])->name('projects.tasks.create');
    Route::get('/projects/{project}/tasks/{task}', [ProjectController::class, 'allTasks'])->name('projects.tasks.show');
    Route::get('/projects/{project}/tasks/{task}/edit', [ProjectController::class, 'editTask'])->name('projects.tasks.edit');




    Route::delete('/user/deleteImage/{id}', [UserController::class, 'deleteImage'])->name('users.deleteImage');

    Route::get('/tasks/user/{userId}', [TaskController::class, 'profile']);

    Route::get('notifications', [TaskController::class, 'taskNotification'])->name('notifications');



    Route::get('activity-log', [UserController::class, 'logActivity'])->name('activity');
});
