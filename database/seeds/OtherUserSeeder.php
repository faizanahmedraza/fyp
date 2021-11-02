<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class OtherUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-fyp-proposal-list',
            'user-fyp-proposal-create',
            'user-funded-proposal-list',
            'user-funded-proposal-create',
            'user-funded-project-list',
            'user-funded-project-create',
            'user-fyp-project-list',
            'user-fyp-project-create',
            'user-notification-list',
            'user-notification-detail',
            'user-event-list',
        ];

        $oricFacultyPermissions = [
            'user-event-create',
            'user-event-update',
        ];

        $allPermissions = array_merge($permissions,$oricFacultyPermissions);

        foreach ($allPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $student = Role::findByName('student');
        $oric_member = Role::findByName('oric-member');
        $researcher = Role::findByName('researcher');
        $faculty = Role::findByName('faculty');
        $focal_person = Role::findByName('focal-person');

        $student->syncPermissions($permissions);
        $oric_member->syncPermissions($allPermissions);
        $researcher->syncPermissions($permissions);
        $faculty->syncPermissions($allPermissions);
        $focal_person->syncPermissions($permissions);
    }
}
