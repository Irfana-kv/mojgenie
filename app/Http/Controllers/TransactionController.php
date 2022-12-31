<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //
    public function home()
    {
        $title = 'Home';
        $balance = Transaction::where('user_id', auth()->user()->id)->latest()->first();
        if($balance){
            $balance=$balance->balance;
        }else{
            $balance=0;
        }
        return view('home', compact('title', 'balance'));
    }

    public function deposit()
    {
        $title = 'Deposit';
        return view('deposit', compact('title'));
    }

    public function deposit_amount(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->amount = $request->amount;
        $transaction->type = 'Deposit';
        $lastTransction = Transaction::where('user_id', auth()->user()->id)->latest()->first();
        if ($lastTransction != NULL) {
            $transaction->balance = (int)$lastTransction->balance + (int)$request->amount;
        } else {
            $transaction->balance = $request->amount;
        }
        if ($transaction->save()) {
            session()->flash('success', 'Amount Deposit Successfully');
            return redirect('home');
        } else {

            session()->flash('error', 'Deposit Failed');
            return redirect('deposit');
        }
    }



    public function withdraw()
    {
        $title = 'Withdraw';
        $balance = Transaction::where('user_id', auth()->user()->id)->latest()->first();
        if($balance){
            $balance=$balance->balance;
        }else{
            $balance=0;
        }
        return view('withdraw', compact('title', 'balance'));
    }

    public function withdraw_amount(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|max:' . $request->balance . '',
        ]);

        $transaction = new Transaction();
        $transaction->user_id = auth()->user()->id;
        $transaction->amount = $request->amount;
        $transaction->type = 'Withdraw';
        $lastTransction = Transaction::where('user_id', auth()->user()->id)->latest()->first();
        if ($lastTransction != NULL) {
            $transaction->balance = (int)$lastTransction->balance - (int)$request->amount;
        } else {
            $transaction->balance = $request->amount;
        }
        if ($transaction->save()) {
            session()->flash('success', 'Amount Withdraw Successfully');
            return redirect('home');
        } else {

            session()->flash('error', 'Withdraw Failed');
            return redirect('withdraw');
        }
    }



    public function transfer()
    {
        $title = 'Transfer';
        $balance = Transaction::where('user_id', auth()->user()->id)->latest()->first();
        if($balance){
            $balance=$balance->balance;
        }else{
            $balance=0;
        }
        return view('transfer', compact('title', 'balance'));
    }

    public function transfer_amount(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'amount' => 'required|numeric|max:' . $request->balance . '',
        ]);

        if (User::where('email', $request->email)->exists()) {
            $transaction = new Transaction();
            $transaction->user_id = auth()->user()->id;
            $transaction->amount = $request->amount;
            $transaction->type = 'Transfer';
            $lastTransction = Transaction::where('user_id', auth()->user()->id)->latest()->first();

            $transferToUser = User::where('email', $request->email)->first();
            $transaction->transfer_user_id = $transferToUser->id;
            if ($lastTransction != NULL) {
                $transaction->balance = (int)$lastTransction->balance - (int)$request->amount;
            } else {
                $transaction->balance = $request->amount;
            }
            if ($transaction->save()) {

                $balanceUpdate = new Transaction();
                $balanceUpdate->user_id = $transferToUser->id;
                $balanceUpdate->amount = $request->amount;
                $balanceUpdate->type = 'TransferDeposit';
                $balanceUpdate->transfer_user_id = auth()->user()->id;
                $currentBalance = Transaction::where('user_id', $transferToUser->id)->latest()->first();
                if ($currentBalance != NULL) {
                    $balanceUpdate->balance = (int)$currentBalance->balance + (int)$request->amount;
                } else {
                    $balanceUpdate->balance = $request->amount;
                }
                if ($balanceUpdate->save()) {
                    session()->flash('success', 'Amount transfer Successfully');
                    return redirect('home');
                } else {
                    session()->flash('error', 'Transfer Failed');
                    return redirect('transfer');
                }
            } else {

                session()->flash('error', 'Transfer Failed');
                return redirect('transfer');
            }
        } else {
            session()->flash('error', 'Transfer account not Found');
            return redirect('transfer');
        }
    }



    public function statements()
    {
        $title = 'Statements';
        $transactions = Transaction::where('user_id',auth()->user()->id)->oldest()->get();
        return view('statements', compact('title', 'transactions'));
    }


}
