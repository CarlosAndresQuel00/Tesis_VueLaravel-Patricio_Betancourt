<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\AssignmentController;
use App\Http\Controllers\Api\MembershipController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReserveController;
use App\Http\Controllers\Api\SharedSpaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('comments', [CommentController::class, 'index']);
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::get('assignments', [AssignmentController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('shared_spaces', SharedSpaceController::class);
    Route::apiResource('memberships', MembershipController::class);
    Route::apiResource('reserves', ReserveController::class);

    // Assignments
    Route::get('assignments/{assignment}', [AssignmentController::class, 'show']);
    Route::post('assignments', [AssignmentController::class, 'store']);
    Route::put('assignments/{assignment}',  [AssignmentController::class, 'update']);
    Route::delete('assignments/{assignment}', [AssignmentController::class, 'delete']);

    // Payments
    Route::get('assignments/{assignment}/payments', [PaymentController::class, 'index']);
    Route::get('assignments/{assignment}/payments/{payment}', [PaymentController::class, 'show']);
    Route::post('assignments/{assignment}/payments', [PaymentController::class, 'store']);
    Route::put('assignments/{assignment}/payments/{payment}',  [PaymentController::class, 'update']);
    Route::delete('assignments/{assignment}/payments/{payment}', [PaymentController::class, 'delete']);
});
