<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction\Transaction;
use App\Http\Requests\Transaction\CreateTransactionRequest;

class CreateTransactionController extends Controller
{
    public function createTransaction(CreateTransactionRequest $request)
    {
        $arData = [
            'user_id' => $request->post('user_id'),
            'type' => $request->post('type'),
            'comment' => $request->post('comment') ?? 'text',
            'sum' => $request->post('sum'),
        ];

        if (Transaction::create($arData)) {
            return redirect('/transaction');
        }

        return redirect('/404');
    }
}
