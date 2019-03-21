<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        // create permissions

        /* city manager permissions */
        Permission::create(['name'=>'create gym']);
        Permission::create(['name'=>'show gym']);
        Permission::create(['name'=>'edit gym']);
        Permission::create(['name'=>'delete gym']);

        Permission::create(['name'=>'create manager']);
        Permission::create(['name'=>'show manager']);
        Permission::create(['name'=>'edit manager']);
        Permission::create(['name'=>'delete manager']);
        Permission::create(['name'=>'ban manager']);
        Permission::create(['name'=>'unBan manager']);
        /* city and gym manager permissions */

        Permission::create(['name'=>'create session']);
        Permission::create(['name'=>'show session']);
        Permission::create(['name'=>'edit session']);
        Permission::create(['name'=>'delete session']);

        Permission::create(['name'=>'create package']);
        Permission::create(['name'=>'show package']);
        Permission::create(['name'=>'edit package']);
        Permission::create(['name'=>'delete package']);
        /* Admin role + */
        Permission::create(['name'=>'create CityManager']);
        Permission::create(['name'=>'show CityManager']);
        Permission::create(['name'=>'edit CityManager']);
        Permission::create(['name'=>'delete CityManager']);
        Permission::create(['name'=>'ban CityManager']);
        Permission::create(['name'=>'unBan CityManager']);
        /* give roles permissions */
        // create roles
        $cityManagerRole = Role::create(['name' => 'city-manager']);
        $gymManagerRole = Role::create(['name' => 'gym-manager']);
        $adminRole = Role::create(['name' => 'super-admin']);
        $cityManagerRole->givePermissionTo('create gym','show gym','edit gym','delete gym',
            'create manager','show manager','edit manager','delete manager','ban manager','unBan manager',
            'create session','show session','edit session','delete session','create package',
        'show package','edit package','delete package');

        $gymManagerRole->givePermissionTo('create session','show session','edit session','delete session','create package',
            'show package','edit package','delete package');
        $adminRole->givePermissionTo(Permission::all());

    }
}
