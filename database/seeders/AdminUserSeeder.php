<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //akun untuk Admin
        User::create([
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@admin.app',
            'password' => Hash::make('12345678')
        ]);

        //akun untuk kasir
        User::create([
            'name' => 'Kasir',
            'role' => 'kasir',
            'email' => 'kasir@kasir.app',
            'password' => Hash::make('12345678')
        ]);
        // User::create([
        //     'name' => 'Kasir2',
        //     'role' => 'kasir',
        //     'email' => 'kasir2@kasir.app',
        //     'password' => Hash::make('12345678')
        // ]);
        // User::create([
        //     'name' => 'Kasir3',
        //     'role' => 'kasir',
        //     'email' => 'kasir3@kasir.app',
        //     'password' => Hash::make('12345678')
        // ]);
        // User::create([
        //     'name' => 'Kasir4',
        //     'role' => 'kasir',
        //     'email' => 'kasir4@kasir.app',
        //     'password' => Hash::make('12345678')
        // ]);
        // User::create([
        //     'name' => 'Kasir5',
        //     'role' => 'kasir',
        //     'email' => 'kasir5@kasir.app',
        //     'password' => Hash::make('12345678')
        // ]);
        // User::create([
        //     'name' => 'Kasir6',
        //     'role' => 'kasir',
        //     'email' => 'kasir6@kasir.app',
        //     'password' => Hash::make('12345678')
        // ]);
        // User::create([
        //     'name' => 'Kasir7',
        //     'role' => 'kasir',
        //     'email' => 'kasir7@kasir.app',
        //     'password' => Hash::make('12345678')
        // ]);
        // User::create([
        //     'name' => 'Kasir8',
        //     'role' => 'kasir',
        //     'email' => 'kasir8@kasir.app',
        //     'password' => Hash::make('12345678')
        // ]);
        // User::create([
        //     'name' => 'Kasir9',
        //     'role' => 'kasir',
        //     'email' => 'kasir9@kasir.app',
        //     'password' => Hash::make('12345678')
        // ]);
        // User::create([
        //     'name' => 'Kasir10',
        //     'role' => 'kasir',
        //     'email' => 'kasir10@kasir.app',
        //     'password' => Hash::make('12345678')
        // ]);
        // User::create([
        //     'name' => 'Kasir11',
        //     'role' => 'kasir',
        //     'email' => 'kasir11@kasir.app',
        //     'password' => Hash::make('12345678')
        // ]);
    }
}