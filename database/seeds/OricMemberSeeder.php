<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class OricMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'oric-member-project-proposal-list',
            'oric-member-project-proposal-create',
            'oric-member-notification-list',
            'oric-member-notification-detail',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'oric-member']);

        $role->syncPermissions($permissions);
    }
}
