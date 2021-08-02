<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    public function run()
    {
//        DB::table((new User)->getTable())->truncate();

        User::insert([
            ['id' => 12, 'name' => 'Mahasiswa1', 'email' => 'mahasiswa1@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 13, 'name' => 'Mahasiswa2', 'email' => 'mahasiswa2@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 14, 'name' => 'Mahasiswa3', 'email' => 'mahasiswa3@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 15, 'name' => 'Mahasiswa4', 'email' => 'mahasiswa4@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 16, 'name' => 'Mahasiswa5', 'email' => 'mahasiswa5@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 17, 'name' => 'Mahasiswa6', 'email' => 'mahasiswa6@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 18, 'name' => 'Mahasiswa7', 'email' => 'mahasiswa7@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 19, 'name' => 'Mahasiswa8', 'email' => 'mahasiswa8@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 20, 'name' => 'Mahasiswa9', 'email' => 'mahasiswa9@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 21, 'name' => 'Mahasiswa10', 'email' => 'mahasiswa10@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 22, 'name' => 'Mahasiswa11', 'email' => 'mahasiswa11@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 23, 'name' => 'Mahasiswa12', 'email' => 'mahasiswa12@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 24, 'name' => 'Mahasiswa13', 'email' => 'mahasiswa13@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 25, 'name' => 'Mahasiswa14', 'email' => 'mahasiswa14@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 26, 'name' => 'Mahasiswa15', 'email' => 'mahasiswa15@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 27, 'name' => 'Mahasiswa16', 'email' => 'mahasiswa16@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 28, 'name' => 'Mahasiswa17', 'email' => 'mahasiswa17@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 29, 'name' => 'Mahasiswa18', 'email' => 'mahasiswa18@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 30, 'name' => 'Mahasiswa19', 'email' => 'mahasiswa19@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 31, 'name' => 'Mahasiswa20', 'email' => 'mahasiswa20@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 32, 'name' => 'Mahasiswa21', 'email' => 'mahasiswa21@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 33, 'name' => 'Mahasiswa22', 'email' => 'mahasiswa22@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 34, 'name' => 'Mahasiswa23', 'email' => 'mahasiswa23@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 35, 'name' => 'Mahasiswa24', 'email' => 'mahasiswa24@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 36, 'name' => 'Mahasiswa25', 'email' => 'mahasiswa25@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 37, 'name' => 'Mahasiswa26', 'email' => 'mahasiswa26@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 38, 'name' => 'Mahasiswa27', 'email' => 'mahasiswa27@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 39, 'name' => 'Mahasiswa28', 'email' => 'mahasiswa28@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 40, 'name' => 'Mahasiswa29', 'email' => 'mahasiswa29@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 41, 'name' => 'Mahasiswa30', 'email' => 'mahasiswa30@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 42, 'name' => 'Mahasiswa31', 'email' => 'mahasiswa31@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 43, 'name' => 'Mahasiswa32', 'email' => 'mahasiswa32@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 44, 'name' => 'Mahasiswa33', 'email' => 'mahasiswa33@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 45, 'name' => 'Mahasiswa34', 'email' => 'mahasiswa34@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 46, 'name' => 'Mahasiswa35', 'email' => 'mahasiswa35@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 47, 'name' => 'Mahasiswa36', 'email' => 'mahasiswa36@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 48, 'name' => 'Mahasiswa37', 'email' => 'mahasiswa37@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 49, 'name' => 'Mahasiswa38', 'email' => 'mahasiswa38@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 50, 'name' => 'Mahasiswa39', 'email' => 'mahasiswa39@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 51, 'name' => 'Mahasiswa40', 'email' => 'mahasiswa40@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
            ['id' => 52, 'name' => 'Mahasiswa41', 'email' => 'mahasiswa41@admin.com', 'password' => \Illuminate\Support\Facades\Hash::make('mahasiswa'), 'role_id' => 2, 'remember_token' => '',],
        ]);
    }
}
