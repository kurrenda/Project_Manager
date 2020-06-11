<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::create(['name' => 'Admin']);
        $team = Role::create(['name' => 'Team Leader']);
        $userR = Role::create(['name' => 'Pracownik']);

        $user = Factory(App\User::class)->create([
            'name' => 'Adam Małysz',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);
        $user->assignRole($team);

        $user2 = Factory(App\User::class)->create([
            'name' => 'Jacek Stachurski',
            'email' => 'jacek@jacek.com',
            'password' => bcrypt('admin'),
        ]);

        $user3 = Factory(App\User::class)->create([
            'name' => 'Gosia Andrzejewicz',
            'email' => 'gosia@gosia.com',
            'password' => bcrypt('admin'),
        ]);

        $user3->assignRole($userR);
        $user2->assignRole($admin);
    }
}
