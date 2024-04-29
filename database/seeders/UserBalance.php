<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserBalance extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::all()->pluck('id');

        foreach ($userIds as $uId) {
            DB::table('user_balance')->insert([
                'user_id' => $uId,
                'balance' => 0,
            ]);
        }
    }
}
