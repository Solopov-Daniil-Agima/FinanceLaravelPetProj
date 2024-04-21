<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction\{Transaction, TransactionMinus, TransactionPlus};
use App\Models\User\{UserBalance, UserGroup, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function getUserInfoById($userId)
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

    public function getAllUserInfo($excludedId)
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
    public function getTransactions()
    {
        $userId = (Auth::user())->id;
        $userGroup = (UserGroup::where('user_id', $userId)->first())->group_id;
        $arrayInfo = ['UserGroup' => $userGroup];

        if ($userGroup == 1) {
            $arrayInfo['info'] = $this->getAllUserInfo($userId);
        } else {
            $arrayInfo['info'] = $this->getUserInfoById($userId);
        }

        return view('transactions.main', $arrayInfo);
    }

}
