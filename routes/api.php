<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    // Route::post('logout', 'AuthController@logout');
    // Route::post('refresh', 'AuthController@refresh');
    // Route::post('me', 'AuthController@me');

});




Route::group([
    'middleware' => [
        'auth.jwt', 
        'role:super-admin|admin',   
        'setlocale'
        // 'permission:read-store|create-store|update-store|delete-store'                    // ຖືກອັນໃດອັນໜຶ່ງໃນນີ້
        // 'permission:read-store|create-store|update-store|delete-store,require_all'       // ຕ້ອງຖືກຕ້ອງທັງໝົດທີ່ກຳນົດໃນນີ້
    ],
    'prefix' => 'admin',
], function() {
    Route::get('list-users', [UserController::class, 'listUsers'])->name('list.users');
    // Route::get('list-users', [UserController::class, 'listUsers'])->name('list.users')->middleware('permission:create-store|update-store,require_all');

    Route::get('list-stores', [StoreController::class, 'listStores'])->name('list.stores');
    Route::post('add-store', [StoreController::class, 'addStore'])->name('add.store');
    Route::put('edit-store/{id}', [StoreController::class, 'editStore'])->name('edit.store');
    Route::delete('delete-store/{id}', [StoreController::class, 'deleteStore'])->name('delete.store');

});

Route::post('send-email-otp', [EmailController::class, 'sendEmailOTP']);

