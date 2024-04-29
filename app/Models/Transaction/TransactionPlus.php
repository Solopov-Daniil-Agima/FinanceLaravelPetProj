<?php

namespace App\Models\Transaction;

use App\Models\User\User;
use App\Models\User\UserBalance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPlus extends Model
{
    use HasFactory;

    protected $table = 'transactions_plus';

    protected $fillable = ['user_id', 'sum', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($transactionPlus) {
            Transaction::create([
                'user_id' => $transactionPlus->user_id,
                'transaction_id' => $transactionPlus->id,
            ]);

            $user = UserBalance::where('user_id', $transactionPlus->user_id)->first();
            $userBalance = ($user)->balance;

            $newSum = intval($userBalance) + intval($transactionPlus->sum);
            $user->balance = $newSum;

            $user->save();
        });
    }
}
