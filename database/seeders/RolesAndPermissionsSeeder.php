<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $entities = [
            'user', 'role', 'permission', 'vehicle','driver', 'fuel',
            'fuel_request_reason', 'fuel_measurement', 'fuel_report', 'vehicle_type',
            'trip', 'fuel_request','fuel_price', 'fuel_distribution', 'station',
            'vehicle_performance', 'office', 'driver',
        ];

        foreach ($entities as $entity) {
            Permission::firstOrCreate(['name' => "create $entity"]);
            Permission::firstOrCreate(['name' => "view $entity"]);
            Permission::firstOrCreate(['name' => "edit $entity"]);
            Permission::firstOrCreate(['name' => "delete $entity"]);
        }

        $admin = Role::firstOrCreate(['name' => 'Fuel admin']);
        $admin->givePermissionTo(Permission::all());

        $staff = Role::firstOrCreate(['name' => 'Fuel distribution_staff']);
        $staff->givePermissionTo([
            'view vehicle', 'view fuel', 'view fuel_request', 'create fuel_request',
            'view vehicle_performance', 'create vehicle_performance',
        ]);
        $user = \App\Models\User::find(1);
        $user2 = \App\Models\User::find(1);
        $user->assignRole('Fuel admin');
        $user2->assignRole('Fuel admin');
    }
}
