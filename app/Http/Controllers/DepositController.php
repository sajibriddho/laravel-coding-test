<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    /*---------------
    | Manage Deposit
    ----------------*/
    public function deposits()
    {
        $data['users'] = User::get();
        $transaction = Transaction::where('transaction_type', 'deposit');
        $data['totalRows'] = $transaction->count();
        $data['deposits'] = $transaction->paginate(10);
        return view('backend.deposit.deposits', $data);
    }
    public function storeDeposits(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ]);
        $userId = $request->user_id;
        $deposit = new Transaction();
        $deposit->user_id = $userId;
        $deposit->transaction_type = 'deposit';
        $deposit->amount = $request->amount;
        $deposit->fee = 0;
        $deposit->date = Carbon::now()->format('Y-m-d');
        if ($deposit->save()) {
            $userInfo = User::find($userId);
            $oldBalance = $userInfo->balance;
            $userInfo->balance = $oldBalance + $deposit->amount;
            if ($userInfo->save()) {
                return redirect()->back()->with('success', 'Deposit Successful');
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
