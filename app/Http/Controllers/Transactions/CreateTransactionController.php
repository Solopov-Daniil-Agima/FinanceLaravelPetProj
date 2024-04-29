<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\CreateTransactionRequest;
use App\Factories\TransactionFactory;

class CreateTransactionController extends Controller
{
    public function createTransaction(CreateTransactionRequest $request)
    {
        $arData = [
            'user_id' => $request->post('user_id'),
            'sum' => $request->post('sum'),
            'status' => 'completed',
        ];

        if(TransactionFactory::create($arData, $request->post('type'))){
            return redirect('/transaction');
        }

        return redirect('/404');
    }
}
