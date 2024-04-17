<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetAllTransactionController extends Controller
{
    public function getAll()
    {
        $userId = (Auth::user())->id;
        if ($userId > 0){
            $userGroup = (UserGroup::where('user_id', $userId)->first())->group_id;

            //буду разные представления показывать
            if ($userGroup == 1){ //admin ввести коснтанту ADMIN_GROUP_ID
                echo '<pre>';
                print_r(AccountTransaction::select('id', 'user_id', 'sum', 'status')
                    ->get()->toArray());
                echo '</pre>';
            } else {
                echo '<pre>';

                print_r(
                    AccountTransaction::where('user_id', $userId)
                        ->select('id', 'user_id', 'sum', 'status')
                        ->get()->toArray());

                echo '</pre>';
            }
        }
    }
}
