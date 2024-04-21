<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction\TransactionMinus;
use App\Models\Transaction\TransactionPlus;
use App\Models\User\UserBalance;

class CreateTransactionController extends Controller
{
    public function createTransaction(Request $request)
    {
        $sum = $request->post('sum');
        $type = $request->post('type');
        $userId = $request->post('user_id');
        $user = UserBalance::where('user_id', $userId)->first();
        $userBalance = ($user)->balance;

        if ($type == 'minus'){
            TransactionMinus::create([
                'user_id' => $userId,
                'sum' => $sum,
                'status' => 'completed',
            ]);

            $newSum = intval($userBalance) - intval($sum);
            $user->balance = $newSum;
        }

        if ($type == 'plus'){
            TransactionPlus::create([
                'user_id' => $userId,
                'sum' => $sum,
                'status' => 'completed',
            ]);

            $newSum = intval($userBalance) + intval($sum);
            $user->balance = $newSum;
        }

        $user->save();

        return redirect('/transaction');
    }
}
