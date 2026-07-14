<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->createOrFirst([
            'id' => 1,
            'email' => 'admin@shop.com',
            'password' => Hash::make('shop2027'),
            'is_admin' => true,
        ]);
    }
}
