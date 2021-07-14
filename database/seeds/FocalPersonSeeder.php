<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FocalPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'focal-person-project-proposal-list',
            'focal-person-project-proposal-create',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'focal-person']);

        $role->syncPermissions('user-notification-list','user-notification-detail','user-event-list',...$permissions);
    }
}
