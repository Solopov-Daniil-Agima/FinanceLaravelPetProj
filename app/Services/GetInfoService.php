<?php

namespace App\Services;

use App\Models\Transaction\Transaction;
use App\Models\User\User;
use App\Models\User\UserBalance;
use App\Models\User\UserGroup;
use Illuminate\Support\Facades\Auth;

class GetInfoService
{
    private function getUserInfoById(User $user) : array
    {
        return [
            'balance' => $user->userBalance->balance,
            'comment' => $user->comment,
            'transactions_minus' => $user->transaction()->where('type', 'minus')->get()->map(function (Transaction $transaction) {
                return [
                    'sum' => $transaction->sum,
                    'created_at' => $transaction->created_at->format('Y-m-d H:i:s'),
                    'id' => $transaction->id,
                ];
            })->toArray(),
            'transactions_plus' => $user->transaction()->where('type', 'plus')->get()->map(function (Transaction $transaction) {
                return [
                    'sum' => $transaction->sum,
                    'created_at' => $transaction->created_at->format('Y-m-d H:i:s'),
                    'id' => $transaction->id,
                ];
            })->toArray(),
            'name' => $user->name,
            'email' => $user->email,
            'user_id' => $user->id,
        ];
    }

    private function getAllUserInfo(User $excludedUser) : array
    {
        $users = User::all()->filter(function (User $user) use ($excludedUser) {
            return $user->id !== $excludedUser->id;
        });

        $arResult = [];
        foreach ($users as $user) {
            $arResult[$user->id] = $this->getUserInfoById($user);
        }

        return $arResult;
    }

    public function getData() : array
    {
        $user = Auth::user();
        $userGroup = (UserGroup::where('user_id', $user->id)->first())->group_id;
        $arrayInfo = ['UserGroup' => $userGroup];

        if ($userGroup == UserGroup::ADMIN_GROUP) {
            $arrayInfo['info'] = $this->getAllUserInfo($user);
        } else {
            $arrayInfo['info'] = $this->getUserInfoById($user);
        }

        return $arrayInfo;
    }

    public function getExcelData(User $user) : array
    {
        return $this->getUserInfoById($user);
    }
}
