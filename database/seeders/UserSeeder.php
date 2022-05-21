<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $password = 'password';

        $data = [
            'name' => "admin",
            'email' => 'admin@laravel.com',
            'password' => Hash::make($password),
        ];

        if (DB::table('users')->count() == 0) {
            echo " =>Creating default admin:\n =>Email: {$data['email']}\n =>Password: {$password}\n";
            DB::table('users')->insert($data);
        }
    }
}
