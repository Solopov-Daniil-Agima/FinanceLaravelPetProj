<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateTransactionController extends Controller
{
    public function createTransaction(Request $request)
    {
        $this->isUserAuthorize();

        $userId = (Auth::user())->id;


        if ($userId > 0) {
            $user = UserBalance::where('user_id', $userId)->first();
            $userBalance = ($user)->balance;

            $sum = $request->query('sum');
            $newSum = intval($userBalance) + intval($sum);

            $transaction = AccountTransaction::create([
                'user_id' => $userId,
                'sum' => $sum,
                'status' => 'completed',
            ]);

            $user->balance = $newSum;
            $user->save();

            echo '<pre>';
            print_r('userId-'.$userId);
            echo '<br>';
            print_r('transaction-'.$transaction);
            echo '</pre>';
        }
    }
}
