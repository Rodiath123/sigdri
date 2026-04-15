<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'superadmin@sigdri.bj'],
            [
                'nom'       => 'Super Administrateur',
                'password'  => Hash::make('Admin@1234'),
                'role'      => 'super_admin',
                'est_actif' => true,
            ]
        );

        $user->assignRole('super_admin');
    }
}