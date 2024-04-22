<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction\TransactionMinus;
use App\Models\Transaction\TransactionPlus;
use App\Models\User\UserBalance;
use App\Http\Requests\Transaction\CreateTransactionRequest;

class CreateTransactionController extends Controller
{
    public function createTransaction(CreateTransactionRequest $request)
    {
        $sum = $request->post('sum');
        $type = $request->post('type');
        $userId = $request->post('user_id');

        if ($type == 'minus'){
            TransactionMinus::create([
                'user_id' => $userId,
                'sum' => $sum,
                'status' => 'completed',
            ]);
        }

        if ($type == 'plus'){
            TransactionPlus::create([
                'user_id' => $userId,
                'sum' => $sum,
                'status' => 'completed',
            ]);
        }

        return redirect('/transaction');
    }
}
