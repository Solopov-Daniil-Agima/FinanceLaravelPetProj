<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Services\GetInfoService;

class TransactionController extends Controller
{
    public function getAllTransaction(GetInfoService $service)
    {
        return view('transactions.main', $service->getData());
    }
}
