<?php

namespace App\Models\Transaction;

use App\Models\User\User;
use App\Models\User\UserBalance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMinus extends Model
{
    use HasFactory;

    protected $table = 'transactions_minus';

    protected $fillable = ['user_id', 'sum'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($transactionMinus) {
            Transaction::create([
                'user_id' => $transactionMinus->user_id,
                'transaction_id' => $transactionMinus->id,
                'transaction_type' => 'minus',
            ]);

            $user = UserBalance::where('user_id', $transactionMinus->user_id)->first();
            $userBalance = ($user)->balance;

            $newSum = intval($userBalance) - intval($transactionMinus->sum);
            $user->balance = $newSum;

            $user->save();
        });
    }
}
