<?php

namespace App\Factories;

use App\Models\Transaction\TransactionMinus;
use App\Models\Transaction\TransactionPlus;

class TransactionFactory
{
    public static function create(array $data, $type)
    {
        return match($type) {
            'minus' => TransactionMinus::create($data),
            'plus' => TransactionPlus::create($data),
        };
    }
}
