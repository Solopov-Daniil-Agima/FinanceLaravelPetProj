<?php

namespace App\Models\Transaction;

use App\Models\User\User;
use App\Models\User\UserBalance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction_table';

    protected $fillable = ['user_id', 'type', 'sum', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($transaction) {
            $user = UserBalance::where('user_id', $transaction->user_id)->first();
            $userBalance = ($user)->balance;

            $newSum = $transaction->type === 'plus' ? intval($userBalance) + intval($transaction->sum) : intval($userBalance) - intval($transaction->sum);

            $user->balance = $newSum;

            $user->save();
        });
    }
}
