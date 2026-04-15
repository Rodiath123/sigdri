<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $permissions = [
            'gerer_utilisateurs',
            'gerer_unites',
            'gerer_catalogues',
            'valider_declarations',
            'rejeter_declarations',
            'voir_declarations',
            'creer_declaration',
            'generer_rapports',
            'voir_dashboard',
            'gerer_alertes',
            'voir_alertes',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Rôles + permissions associées
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            'gerer_unites', 'gerer_catalogues',
            'voir_declarations', 'voir_dashboard',
            'generer_rapports', 'gerer_alertes',
        ]);

        $agent = Role::firstOrCreate(['name' => 'agent']);
        $agent->givePermissionTo([
            'voir_declarations', 'valider_declarations',
            'rejeter_declarations', 'generer_rapports',
            'voir_dashboard', 'voir_alertes', 'gerer_alertes',
        ]);

        $industriel = Role::firstOrCreate(['name' => 'industriel']);
        $industriel->givePermissionTo([
            'creer_declaration', 'voir_declarations', 'voir_alertes',
        ]);
    }
}