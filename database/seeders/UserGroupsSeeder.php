<?php

namespace Database\Seeders;

use App\Models\User\Group;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::all()->pluck('id');
        $groupsIds = count(Group::all()->pluck('id'));

        foreach ($userIds as $uId) {
            DB::table('user_groups')->insert([
                'user_id' => $uId,
                'group_id' => rand(1, $groupsIds),
            ]);
        }
    }
}
