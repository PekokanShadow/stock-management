<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $adminUser = User::firstOrCreate(
            ['username' => 'mulyono'],
            [
                'name' => 'Mulyono',
                'password' => Hash::make('mulyono1'),
            ]
        );

        // Assign 'admin' role using Spatie's Role model
        $adminUser->assignRole('admin');
    }
}
