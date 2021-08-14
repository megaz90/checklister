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
    Route::get('/checklist/all/{checklist}', [App\Http\Controllers\Admin\ChecklistGroupController::class, 'getAllData'])->name('checklistGroupData');

    Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function () {
        Route::resource('pages', \App\Http\Controllers\Admin\PagesController::class)->only(['edit', 'update']);
        Route::resource('checklist_groups', \App\Http\Controllers\Admin\ChecklistGroupController::class);
        Route::resource('checklist_groups.checklists', \App\Http\Controllers\Admin\ChecklistController::class);
        Route::resource('checklists.tasks', \App\Http\Controllers\Admin\TaskController::class);
        Route::resource('users', \App\Http\Controllers\Admin\UsersController::class);
        Route::resource('roles', \App\Http\Controllers\Admin\RolesController::class);
        Route::resource('permissions', \App\Http\Controllers\Admin\PermissionsController::class)->middleware('check_role_exist');

        Route::get('/reauth/show', [App\Http\Controllers\Auth\ReauthenticateController::class, 'reauth_show'])->name('reauth.show');
        Route::post('/reauth/check', [App\Http\Controllers\Auth\ReauthenticateController::class, 'reauth_check'])->name('reauth.check');

        Route::group(['prefix' => '/authorize', 'as' => 'assign.', 'middleware' => ['admin_reauthenticate', 'check_role_exist']], function () {

            Route::group(['prefix' => '/role-to-user', 'as' => 'role-user.'], function () {
                Route::get('/create', [\App\Http\Controllers\Admin\RolesUsersController::class, 'roleUserCreate'])->name('create');
                Route::post('/store', [\App\Http\Controllers\Admin\RolesUsersController::class, 'roleUserStore'])->name('store');
                Route::get('/getRoles/{id}', [\App\Http\Controllers\Admin\RolesUsersController::class, 'getRoles'])->name('getRoles');
                Route::get('/edit', [\App\Http\Controllers\Admin\RolesUsersController::class, 'roleUserEdit'])->name('edit');
                Route::post('/update', [\App\Http\Controllers\Admin\RolesUsersController::class, 'roleUserUpdate'])->name('update');
            });

            Route::group(['prefix' => '/permission-to-role', 'as' => 'permission-role.'], function () {
                Route::get('/create', [\App\Http\Controllers\Admin\PermissionsRolesController::class, 'permissionRoleCreate'])->name('create');
                Route::post('/store', [\App\Http\Controllers\Admin\PermissionsRolesController::class, 'permissionRoleStore'])->name('store');
                Route::get('/getPermissions/{id}', [\App\Http\Controllers\Admin\PermissionsRolesController::class, 'getPermissions'])->name('getPermissions');
                Route::get('/edit', [\App\Http\Controllers\Admin\PermissionsRolesController::class, 'permissionRoleEdit'])->name('edit');
                Route::post('/update', [\App\Http\Controllers\Admin\PermissionsRolesController::class, 'permissionRoleUpdate'])->name('update');
            });
        });
    });
});
//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