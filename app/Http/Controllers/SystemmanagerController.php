<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SystemmanagerController extends Controller
{
    // Manage Dashboard
    public function managetransactions()
    {
        $data['users'] = User::get();
        $transactions = Transaction::orderBy('id', 'DESC');
        $data['totalRows'] = $transactions->count();
        $data['allTransactions'] = $transactions->paginate(10);
        return view('backend.transaction.transactions', $data);
    }

    /*-------------------------
    | Manage New User
    --------------------------*/
    public function createNewUser()
    {
        return view('backend.login.register');
    }
    public function storeNewUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'account_type' => 'required|string|in:business,individual',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'account_type' => $request->account_type,
            'email' => $request->email,
            'balance' => 0,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'User registered successfully.');
    }

    /*-------------------------
    | Manage User Settings
    --------------------------*/
}
