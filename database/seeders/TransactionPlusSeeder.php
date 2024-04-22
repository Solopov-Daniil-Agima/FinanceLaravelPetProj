<?php

namespace Database\Seeders;

use App\Models\Transaction\Transaction;
use App\Models\Transaction\TransactionPlus;
use App\Models\User\UserBalance;
use Illuminate\Database\Seeder;

class TransactionPlusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 15; $i++) {
            $transaction = TransactionPlus::factory()->create();
        }
    }
}
