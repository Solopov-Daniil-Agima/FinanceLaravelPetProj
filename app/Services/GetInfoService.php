<?php

namespace App\Services;

use App\Models\Transaction\{
    Transaction,
    TransactionMinus,
    TransactionPlus
};
use App\Models\User\{
    UserBalance,
    UserGroup,
    User
};
use Illuminate\Support\Facades\Auth;

class GetInfoService
{
    private function getUserInfoById(int $userId) : array
    {
        $info = [
            'balance' => UserBalance::where('user_id', $userId)->select('balance')->first()->toArray()['balance'],
            'transactions_minus' => TransactionMinus::where('user_id', $userId)->select('id', 'sum', 'status', 'created_at')->get()->toArray(),
            'transactions_plus' => TransactionPlus::where('user_id', $userId)->select('id', 'sum', 'status', 'created_at')->get()->toArray(),
            'name' => User::where('id', $userId)->select('name')->first()->toArray()['name'],
            'email' => User::where('id', $userId)->select('email')->first()->toArray()['email'],
            'user_id' => $userId,
        ];

        return $info;
    }

    private function getAllUserInfo(int $excludedId) : array
    {
        $usersId = User::all()->pluck('id');
        $arResult = [];

        foreach($usersId as $uId){
            if($uId !== $excludedId){
                $arResult[$uId] = $this->getUserInfoById($uId);
            }
        }

        return $arResult;
    }

//toDo ввести константу Админ группы
//toDo подумать над оператором отдачи групп пользователя, if else не та конструкция
    public function getData() : array
    {
        $userId = (Auth::user())->id;
        $userGroup = (UserGroup::where('user_id', $userId)->first())->group_id;
        $arrayInfo = ['UserGroup' => $userGroup];

        if ($userGroup == 1) {
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


