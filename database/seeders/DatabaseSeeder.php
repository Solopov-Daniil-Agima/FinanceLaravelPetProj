<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
