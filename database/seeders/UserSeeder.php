<?php

namespace Database\Seeders;

use App\Models\TempUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TempUser::create([
            'name' => 'admin',
            'username' => 'admin@gmail.com',
            'password_hash' => Hash::make('12345678'),
        ]);
    }
}
