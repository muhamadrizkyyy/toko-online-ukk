<?php

namespace Database\Seeders;

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
        User::create([
            "name" => "admin",
            "username" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("admin@gmail.com"),
            "role" => "admin"
        ]);

        User::create([
            "name" => "adni",
            "username" => "andi_07",
            "email" => "andi@gmail.com",
            "password" => Hash::make("andi@gmail.com"),
            "province_id" => 11,
            "regency_id" => 1101,
            "address" => "Jl Gatot Subroto No.9",
            "phone" => "08819502056",
            "role" => "buyer",
        ]);
    }
}
