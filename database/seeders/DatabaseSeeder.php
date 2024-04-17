<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GroupSeeder;
use Database\Seeders\UserGroupsSeeder;
use Database\Seeders\UserBalance;
use Database\Seeders\TransactionPlusSeeder;
use Database\Seeders\TransactionMinusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(UserGroupsSeeder::class);
        $this->call(UserBalance::class);
        $this->call(TransactionPlusSeeder::class);
        $this->call(TransactionMinusSeeder::class);
    }
}
