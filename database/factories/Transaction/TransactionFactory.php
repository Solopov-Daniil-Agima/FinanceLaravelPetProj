<?php

namespace Database\Factories\Transaction;

use App\Models\Transaction\Transaction;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'type' => $this->faker->randomElement(['plus', 'minus']),
            'comment' => fake()->text(100),
            'sum' => fake()->randomNumber(3),
        ];
    }
}
