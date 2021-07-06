<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-update',
            'user-delete',
            'role-list',
            'role-create',
            'role-update',
            'role-delete',
            'research-project-list',
            'research-project-create',
            'research-project-update',
            'admin-notification-list',
            'admin-notification-detail',
            'admin-notification-delete',
            'upload-sample-list',
            'upload-sample-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'super-admin']);

        $role->syncPermissions($permissions);

        $user = \App\Models\User::create([
            'first_name' => 'Umer',
            'last_name' => 'Aziz',
            'email' => 'admin@fyp.com',
            'password' => 'admin123',
            'is_verified' => 1,
        ]);

        $user->assignRole($role);
    }
}
