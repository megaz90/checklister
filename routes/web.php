<?php

use App\Http\Controllers\Admin\ChecklistController;
use App\Http\Controllers\Admin\ChecklistGroupController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\PermissionsRolesController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\RolesUsersController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\ReauthenticateController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\User\ChecklistController as UserChecklistController;
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
    Route::get('/welcome', [PageController::class, 'welcome'])->name('welcome');
    Route::get('/get_consultation', [PageController::class, 'consultation'])->name('consultation');
    Route::get('/checklist/{checklist}', [UserChecklistController::class, 'show'])->name('user.checklists.show');
    Route::get('/menu/data', [MenuController::class, 'getMenuData'])->name('menu.data');

    Route::get('/task/complete/{id}', [TaskController::class, 'completeTask'])->name('task.complete');
    Route::get('/task/completed/{checklist}', [TaskController::class, 'completedTasks'])->name('task.checkCompleted');
    Route::get('/checklist/all/{checklist}', [ChecklistGroupController::class, 'getAllData'])->name('checklistGroupData');

    Route::group(['prefix' => '/subscription', 'as' => 'subscription.'], function () {
        Route::get('/page', [App\Http\Controllers\User\SubscriptionController::class, 'create'])->name('create');
    });

    Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function () {
        Route::resource('pages', PagesController::class)->only(['edit', 'update']);
        Route::resource('checklist_groups', ChecklistGroupController::class);
        Route::resource('checklist_groups.checklists', ChecklistController::class);
        Route::resource('checklists.tasks', TaskController::class);
        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class)->middleware('check_role_exist');
        Route::resource('packages', PackageController::class);

        Route::get('/reauth/show', [ReauthenticateController::class, 'reauth_show'])->name('reauth.show');
        Route::post('/reauth/check', [ReauthenticateController::class, 'reauth_check'])->name('reauth.check');

        Route::group(['prefix' => '/authorize', 'as' => 'assign.', 'middleware' => ['admin_reauthenticate', 'check_role_exist']], function () {

            Route::group(['prefix' => '/role-to-user', 'as' => 'role-user.'], function () {
                Route::get('/create', [RolesUsersController::class, 'roleUserCreate'])->name('create');
                Route::post('/store', [RolesUsersController::class, 'roleUserStore'])->name('store');
                Route::get('/getRoles/{id}', [RolesUsersController::class, 'getRoles'])->name('getRoles');
                Route::get('/edit', [RolesUsersController::class, 'roleUserEdit'])->name('edit');
                Route::post('/update', [RolesUsersController::class, 'roleUserUpdate'])->name('update');
            });

            Route::group(['prefix' => '/permission-to-role', 'as' => 'permission-role.'], function () {
                Route::get('/create', [PermissionsRolesController::class, 'permissionRoleCreate'])->name('create');
                Route::post('/store', [PermissionsRolesController::class, 'permissionRoleStore'])->name('store');
                Route::get('/getPermissions/{id}', [PermissionsRolesController::class, 'getPermissions'])->name('getPermissions');
                Route::get('/edit', [PermissionsRolesController::class, 'permissionRoleEdit'])->name('edit');
                Route::post('/update', [PermissionsRolesController::class, 'permissionRoleUpdate'])->name('update');
            });
        });
    });
});
//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