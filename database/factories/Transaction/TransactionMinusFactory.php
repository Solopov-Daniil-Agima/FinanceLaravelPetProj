<?php

namespace Database\Factories\Transaction;

use App\Models\Transaction\TransactionMinus;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionMinusFactory extends Factory
{
    protected $model = TransactionMinus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'sum' => fake()->randomFloat(2, 10, 1000),
            'status' => 'completed',
        ];
    }
}