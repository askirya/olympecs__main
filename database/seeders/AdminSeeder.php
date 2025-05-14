<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'full_name' => 'Администратор',
            'email' => 'help@admin.com',
            'password' => Hash::make('helpme'),
            'phone' => '+7(999)-999-99-99',
            'department' => 'IT отдел',
            'is_admin' => true
        ]);
    }
}