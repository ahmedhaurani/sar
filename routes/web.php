<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Livewire\Departmentanager;
use App\Livewire\Admin\Department\ViewDepartments;
use App\Livewire\RequestForm;
use App\Livewire\Admin\Request\ManageRequests;
use App\Livewire\Admin\PermissionController;
use App\Livewire\Admin\Request\CreateRequest;
use App\Livewire\Admin\Request\EditRequest;
use App\Livewire\Admin\Roles\CreateRole;
use App\Livewire\Admin\Roles\EditRole;
use App\Livewire\Admin\Roles\ViewRoles;
use App\Livewire\Admin\Roles\AddPermissionsToRole;
use App\Livewire\Admin\Roles\ManageRolePermissions;
use App\Livewire\Admin\User\UserIndex;
use App\Livewire\Admin\User\UserCreate;
use App\Livewire\Admin\User\UserEdit;
use App\Livewire\Admin\Candidate\EditCandidate;
use App\Livewire\Admin\Candidate\DeleteCandidate;
use App\Livewire\Admin\Candidate\ViewCandidate;
use App\Livewire\Admin\Candidate\ViewAllCandidates;
use App\Livewire\Admin\GovernorateManage;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Home;
use App\Livewire\SuccessPage;
use App\Livewire\Profile;
use App\Livewire\UserRequests;
use App\Http\Middleware\TrackVisitor;
use  App\Http\Controllers\Auth\LoginController;
use  App\Http\Controllers\Auth\RegisterController;
use  App\Http\Controllers\Auth\ForgotPasswordController;
use  App\Http\Controllers\Auth\ResetPasswordController;
use App\Livewire\Candidates;
use App\Livewire\Admin\Candidate\AddCandidate;

use App\Livewire\Admin\Request\ConfirmDeleteRequest;


Route::middleware([App\Http\Middleware\TrackVisitor::class])->group(function () {
    Route::get('/', Home::class)->name('index');
    Route::get('/success', SuccessPage::class)->name('request.success');
    Route::get('/profile', Profile::class)->middleware('auth')->name('profile');
    Route::get('/req', UserRequests::class)->middleware('auth')->name('user-request');
    Route::get('/send_request', RequestForm::class)->middleware('auth')->name('send_request');
    Route::get('/candidates', Candidates::class)->name('candidates');
});
Auth::routes();



// Route::middleware('guest')->group(function () {
//     Route::get('/login', LoginController::class)->name('login');
//     Route::get('/register', RegisterController::class);
//     Route::get('/forgot', ForgotPasswordController::class);
//     Route::get('/reset', ResetPasswordController::class);
//     });

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::group(['middleware' => ['role:super-admin|admin' , App\Http\Middleware\ComponentLayoutMiddleware::class]], function() {

//    // Route::resource('permissions', PermissionController::class);
//    Route::get('permissions', \App\Livewire\Admin\PermissionController::class);
//     Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController1::class, 'destroy']);

//     // Route::resource('roles', App\Http\Controllers\RoleController::class);
//     // Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
//     // Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
//     // Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);


//     Route::get('admin/roles', ViewRoles::class)->name('roles.index');
//     Route::get('admin/roles/create', CreateRole::class)->name('roles.create');
//     Route::get('admin/roles/edit/{roleId}', EditRole::class)->name('roles.edit');
//   //  Route::get('admin/roles/add-permissions/{roleId}', AddPermissionsToRole::class)->name('roles.add-permissions');

//     Route::get('/roles/{roleId}/permissions', ManageRolePermissions::class)->name('roles.permissions');


//     Route::resource('users', App\Http\Controllers\UserController::class);
//     Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
// // Requests management routes
// //Route::get('admin/requests/create', CreateRequest::class)->name('requests.create')->middleware('can:create request');
// Route::get('admin/requests/{requestId}/edit', EditRequest::class)->name('requests.edit');
// Route::get('/admin/requests', ManageRequests::class)->name('admin.requests');

// });

Route::group([
    'prefix' => 'admin',
    'middleware' => ['role:super-admin|admin|user', App\Http\Middleware\ComponentLayoutMiddleware::class]
], function () {
    Route::get('/', Dashboard::class)->name('admin.dashboard');
    // Permissions routes
    Route::get('permissions', \App\Livewire\Admin\PermissionController::class)->name('permissions.index');
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController1::class, 'destroy']);

    // Roles routes
    Route::get('roles', ViewRoles::class)->name('roles.index');
    Route::get('roles/create', CreateRole::class)->name('roles.create');
    Route::get('roles/edit/{roleId}', EditRole::class)->name('roles.edit');
    Route::get('roles/{roleId}/permissions', ManageRolePermissions::class)->name('roles.permissions');

    // Users routes
    Route::get('/users', UserIndex::class)->name('users.index');
    Route::get('/users/create', UserCreate::class)->name('users.create');
    Route::get('/users/{id}/edit', UserEdit::class)->name('users.edit');

    // Route::get('users', UserManagement::class)->name('users.index');;
    // Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    // Requests management routes
    Route::get('requests/{requestId}/edit', EditRequest::class)->name('requests.edit');
    Route::get('requests', ManageRequests::class)->name('admin.requests');
    Route::get('requests/{requestId}/delete', ConfirmDeleteRequest::class)->name('admin.requests.confirm-delete');

    //settings
    Route::get('settings', Settings::class)->name('admin.settings');
    //Department
    Route::get('departments', ViewDepartments::class)->name('admin.departments.view');
    Route::get('departments/add', \App\Livewire\Admin\Department\AddDepartment::class)->name('admin.departments.add');
    Route::get('departments/edit/{id}', \App\Livewire\Admin\Department\EditDepartment::class)->name('admin.departments.edit');


    Route::get('/candidates/create', AddCandidate::class)->name('admin.candidates.create');;
    // Edit candidate
Route::get('/candidates/{candidateId}/edit', EditCandidate::class)->name('admin.candidates.edit');

// Delete candidate
Route::get('/candidates/{candidateId}/delete', DeleteCandidate::class)->name('admin.candidates.delete');

// View candidate
Route::get('/candidates/{candidateId}/view', ViewCandidate::class)->name('admin.candidates.view');
Route::get('/candidates', ViewAllCandidates::class)->name('admin.candidates.index');

Route::get('/governorates', GovernorateManage::class)->name('admin.governorates');
});





Route::middleware('auth')->group(function () {
    Route::get('/requests/create', RequestForm::class)->name('requests.create');
});
