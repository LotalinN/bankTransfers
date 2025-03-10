<?php
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('banks', BankController::class);
    Route::get('banks/{id}', [BankController::class, 'show']);
    Route::put('banks/{id}', [BankController::class, 'update']);
    Route::delete('banks/{id}', [BankController::class, 'destroy']);
    Route::resource('bank-accounts', BankAccountController::class);
    Route::resource('transactions', TransactionController::class);

    // Создание банковского аккаунта
    Route::post('bank-accounts', [BankAccountController::class, 'store']);
    // Получение списка банковских аккаунтов
    Route::get('bank-accounts', [BankAccountController::class, 'index']);
    // Удаление банковского аккаунта
    Route::delete('bank-accounts/{id}', [BankAccountController::class, 'destroy']);
    // Перевод средств между счетами
    Route::post('transactions', [TransactionController::class, 'store']);
    // Получение истории переводов
    Route::get('transactions', [TransactionController::class, 'index']);

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
    });

    Route::middleware(['auth:api', 'admin'])->group(function () {
        // Административные возможности

            Route::get('users', [AdminController::class, 'index']);
            Route::post('users/{id}/block', [AdminController::class, 'block']);
            Route::post('users/{id}/unblock', [AdminController::class, 'unblock']);   
    });

Route::get('/', function () {
    return view('welcome');
});