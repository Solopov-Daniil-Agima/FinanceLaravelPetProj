<?php

namespace App\Services;

use App\Models\Transaction\TransactionMinus;
use App\Models\Transaction\TransactionPlus;
use App\Models\User\User;
use App\Models\User\UserBalance;
use App\Models\User\UserGroup;
use Illuminate\Support\Facades\Auth;

class GetInfoService
{
    private function getUserInfoById(int $userId) : array
    {
        return[
            'balance' => UserBalance::where('user_id', $userId)->select('balance')->first()->toArray()['balance'],
            'transactions_minus' => TransactionMinus::where('transactions_minus.user_id', $userId)
                ->leftJoin('transaction_table', 'transactions_minus.id', '=', 'transaction_table.transaction_id')
                ->where('transaction_table.transaction_type', 'minus')
                ->select('transactions_minus.sum', 'transactions_minus.created_at', 'transaction_table.id as id') // добавьте другие столбцы из transaction_table, если они нужны
                ->get()
                ->toArray(),
            'transactions_plus' => TransactionPlus::where('transactions_plus.user_id', $userId)
                ->leftJoin('transaction_table', 'transactions_plus.id', '=', 'transaction_table.transaction_id')
                ->where('transaction_table.transaction_type', 'plus')
                ->select('transactions_plus.sum', 'transactions_plus.created_at', 'transaction_table.id as id') // добавьте другие столбцы из transaction_table, если они нужны
                ->get()
                ->toArray(),
            'name' => User::where('id', $userId)->select('name')->first()->toArray()['name'],
            'email' => User::where('id', $userId)->select('email')->first()->toArray()['email'],
            'user_id' => $userId,
        ];
    }

    private function getAllUserInfo(int $excludedId) : array
    {
        $usersId = User::all()->pluck('id');
        $arResult = [];

        foreach ($usersId as $uId) {
            if ($uId !== $excludedId) {
                $arResult[$uId] = $this->getUserInfoById($uId);
            }
        }

        return $arResult;
    }

    public function getData() : array
    {
        $userId = (Auth::user())->id;
        $userGroup = (UserGroup::where('user_id', $userId)->first())->group_id;
        $arrayInfo = ['UserGroup' => $userGroup];

        if ($userGroup == UserGroup::ADMIN_GROUP) {
            $arrayInfo['info'] = $this->getAllUserInfo($userId);
        } else {
            $arrayInfo['info'] = $this->getUserInfoById($userId);
        }

        return $arrayInfo;
    }

    public function getExcelData($userId) : array
    {
        return $this->getUserInfoById($userId);
    }
}
