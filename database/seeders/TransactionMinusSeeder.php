<?php

namespace Database\Seeders;

use App\Models\Transaction\Transaction;
use App\Models\Transaction\TransactionMinus;
use App\Models\User\UserBalance;
use Illuminate\Database\Seeder;

class TransactionMinusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 15; $i++) {
            $transaction = TransactionMinus::factory()->create();

            $user = UserBalance::where('user_id', $transaction->user_id)->first();
            $userBalance = ($user)->balance;

            $sum = $transaction->sum;
            $newSum = intval($userBalance) - intval($sum);

            Transaction::create([
                'user_id' => $transaction->user_id,
                'transaction_id' => $transaction->id,
            ]);

            $user->balance = $newSum;
            $user->save();
        }
    }
}
