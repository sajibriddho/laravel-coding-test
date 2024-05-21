<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    /*---------------
    | Manage Withdrawal
    ----------------*/
    public function withdrawals()
    {
        $data['users'] = User::get();
        $transaction = Transaction::where('transaction_type', 'withdrawal');
        $data['totalRows'] = $transaction->count();
        $data['withdrawals'] = $transaction->paginate(10);
        return view('backend.withdrawal.withdrawals', $data);
    }
    public function storeWithdrawals(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ]);
        $userId = $request->user_id;
        $user = User::find($userId);
        $amount = $request->amount;
        $fee = $this->calculateWithdrawalFee($user, $amount);
        if ($user->balance < $amount + $fee) {
            return redirect()->back()->with('error', 'Insufficient Balance');
        } else {
            $withdrawal = new Transaction();
            $withdrawal->user_id = $userId;
            $withdrawal->transaction_type = 'withdrawal';
            $withdrawal->amount = $amount;
            $withdrawal->fee = $fee;
            $withdrawal->date = Carbon::now()->format('Y-m-d');
            if ($withdrawal->save()) {
                $oldBalance = $user->balance;
                $newBalance = $amount + $fee;
                $user->balance = $oldBalance - $newBalance;
                if ($user->save()) {
                    return redirect()->back()->with('success', 'Withdrawal Successful');
                } else {
                    return redirect()->back()->with('error', 'Something Went Wrong!');
                }
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    }

    private function calculateWithdrawalFee(User $user, $amount)
    {
        $accountType = $user->account_type;
        $today = Carbon::today();
        $firstOfMonth = Carbon::now()->firstOfMonth();
        $fee = 0;
        $rate = $accountType == 'individual' ? 0.015 / 100 : 0.025 / 100;
        if ($accountType == 'individual') {

            // Friday withdrawal charge is free
            if ($today->isFriday()) {
                return 0;
            }

            // First 1000 withdrawal will be free & remaining amount will be charged
            if ($amount <= 1000) {
                return 0;
            }
            $amount -= 1000;

            // FIrst 5000 each month is free
            $totalWithdrawalsThisMonth = Transaction::where('user_id', $user->id)
                ->where('transaction_type', 'withdrawal')
                ->where('created_at', '>=', $firstOfMonth)
                ->sum('amount');

            if ($totalWithdrawalsThisMonth + $amount <= 5000) {
                return 0;
            }

            $remainingFreeLimit = max(0, 5000 - $totalWithdrawalsThisMonth);
            $amount = max(0, $amount - $remainingFreeLimit);
        }

        if ($accountType == 'business') {
            $totalWithdrawals = Transaction::where('user_id', $user->id)
                ->where('transaction_type', 'withdrawal')
                ->sum('amount');
            // Reduce fee after 50000 transaction
            if ($totalWithdrawals >= 50000) {
                $rate = 0.015 / 100;
            }
        }

        $fee = $amount * $rate;
        return $fee;
    }
}
