<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction\{Transaction, TransactionMinus, TransactionPlus};
use App\Models\User\{UserBalance, UserGroup, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function getUserInfoById($userId){

        $info = [
            'balance' => UserBalance::where('user_id', $userId)->select('balance')->first()->toArray()['balance'],
            'transactions_minus' => TransactionMinus::where('user_id', $userId)->select('id', 'sum', 'status')->get()->toArray(),
            'transactions_plus' => TransactionPlus::where('user_id', $userId)->select('id', 'sum', 'status')->get()->toArray(),
        ];

        return $info;
    }

    public function getAllUserInfo($excludedId){

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
    //toDo уйти  от отдачи представлений
    public function getTransactions(){
        $userId = (Auth::user())->id;
        $userGroup = (UserGroup::where('user_id', $userId)->first())->group_id;

        if ($userGroup == 1){
            return view('transactions.Admin', ['AdminInfo' => $this->getAllUserInfo($userId)]);
        }

        return view('transactions.User', ['UserInfo' => $this->getUserInfoById($userId)]);

    }

}
