<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Transaction\TransactionMinus;
use App\Models\Transaction\TransactionPlus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTransactionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:rollback --step=8 --env=testing');

        $this->artisan('migrate');

        $this->artisan('db:seed');
    }

    public function test_making_minus_transaction(): void
    {
        $data = [
            'user_id' => 1,
            'sum' => 52,
        ];

        $transaction = TransactionMinus::create($data);

        $this->assertModelExists($transaction);
    }

    public function test_making_plus_transaction(): void
    {
        $data = [
            'user_id' => 1,
            'sum' => 52,
        ];

        $transaction = TransactionPlus::create($data);

        $this->assertModelExists($transaction);
    }
}
