<?php

namespace Database\Seeders;

use App\Models\Transaction\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            Transaction::factory()->create();
        }
    }
}
