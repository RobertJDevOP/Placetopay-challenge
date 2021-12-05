<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user1 = \App\Models\User::factory()->create();
        $user1->assignRole('admin');
    }
}
