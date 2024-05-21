<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SystemmanagerController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('backend.login.login');
});
Route::get('/create_user', [SystemmanagerController::class, 'createNewUser'])->name('create_user');
Route::post('/store_new_user', [SystemmanagerController::class, 'storeNewUser'])->name('store_new_user');

Route::get('/transactions', [SystemmanagerController::class, 'managetransactions'])->middleware(['auth', 'verified'])->name('transactions');

Route::middleware('auth')->group(function () {
    /*---------------
    | Manage Deposit
    ----------------*/
    Route::get('/deposit', [DepositController::class, 'deposits'])->name('deposit');
    Route::post('/deposit', [DepositController::class, 'storeDeposits'])->name('deposit');

    /*---------------
    | Manage Withdrawal
    ----------------*/
    Route::get('/withdrawal', [WithdrawalController::class, 'withdrawals'])->name('withdrawal');
    Route::post('/withdrawal', [WithdrawalController::class, 'storeWithdrawals'])->name('withdrawal');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
