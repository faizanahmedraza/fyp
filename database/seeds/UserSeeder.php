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
            'admin-notification-list',
            'admin-notification-detail',
            'admin-notification-delete',
            'upload-sample-list',
            'upload-sample-delete',
            'inquiry-list',
            'internship-list',
            'internship-create',
            'internship-update',
            'internship-delete',
            'event-list',
            'event-create',
            'event-update',
            'event-delete',
            'fyp-proposal-list',
            'fyp-proposal-create',
            'fyp-proposal-update',
            'funded-proposal-list',
            'funded-proposal-create',
            'funded-proposal-update',
            'funded-project-list',
            'funded-project-create',
            'funded-project-update',
            'fyp-project-list',
            'fyp-project-create',
            'fyp-project-update',
            'news-list',
            'news-create',
            'news-update',
            'news-delete',
            'blog-list',
            'blog-create',
            'blog-update',
            'blog-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::findById(1);

        $role->syncPermissions($permissions);

//        $user = \App\Models\User::create([
//            'first_name' => 'Umer',
//            'last_name' => 'Aziz',
//            'email' => 'admin@fyp.com',
//            'password' => 'admin123',
//            'is_verified' => 1,
//        ]);
//
//        $user->assignRole($role);
    }
}
