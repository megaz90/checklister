<?php

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


Auth::routes();

Route::redirect('/', 'login');
Route::group(['middleware' => ['auth', 'save_last_action_at']], function () {

    Route::get('/welcome', [App\Http\Controllers\PageController::class, 'welcome'])->name('welcome');
    Route::get('/get_consultation', [App\Http\Controllers\PageController::class, 'consultation'])->name('consultation');
    Route::get('/checklist/{checklist}', [App\Http\Controllers\User\ChecklistController::class, 'show'])->name('user.checklists.show');
    Route::get('/menu/data', [App\Http\Controllers\MenuController::class, 'getMenuData'])->name('menu.data');
    Route::get('/task/complete/{id}', [App\Http\Controllers\Admin\TaskController::class, 'completeTask'])->name('task.complete');
    Route::get('/task/completed/{checklist}', [App\Http\Controllers\Admin\TaskController::class, 'completedTasks'])->name('task.checkCompleted');

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function () {
        Route::get('/users/index', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users.index');
        Route::resource('pages', \App\Http\Controllers\Admin\PagesController::class)->only(['edit', 'update']);
        Route::resource('checklist_groups', \App\Http\Controllers\Admin\ChecklistGroupController::class);
        Route::resource('checklist_groups.checklists', \App\Http\Controllers\Admin\ChecklistController::class);
        Route::resource('checklists.tasks', \App\Http\Controllers\Admin\TaskController::class);
    });
});
