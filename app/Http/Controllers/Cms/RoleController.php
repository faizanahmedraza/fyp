<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-update|role-delete', ['only' => ['index','addRoleData']]);
        $this->middleware('permission:role-create', ['only' => ['addRole','addRoleData']]);
        $this->middleware('permission:role-update', ['only' => ['updateRole','updateRoleData']]);
        $this->middleware('permission:role-delete', ['only' => ['deleteRole']]);

        $this->middleware('permission:user-list|user-create|user-update|user-delete', ['only' => ['index','addUserData']]);
        $this->middleware('permission:user-create', ['only' => ['addUser','addUserData']]);
        $this->middleware('permission:user-update', ['only' => ['updateUser','updateUserData']]);
        $this->middleware('permission:user-delete', ['only' => ['deleteUser']]);

        $this->middleware('permission:research-project-list|research-project-create|research-project-update', ['only' => ['index','addResearchData']]);
        $this->middleware('permission:research-project-create', ['only' => ['addResearch','addResearchData']]);
        $this->middleware('permission:research-project-update', ['only' => ['updateResearch','updateResearchData']]);

        $this->middleware('permission:notification-list|notification-delete|notification-detail', ['only' => ['index','detailNotification']]);
        $this->middleware('permission:notification-delete', ['only' => ['deleteNotification']]);
        $this->middleware('permission:notification-detail', ['only' => ['detailNotification']]);

        $this->middleware('permission:student-notification-list|student-notification-detail', ['only' => ['index','detailNotification']]);
        $this->middleware('permission:student-notification-detail', ['only' => ['detailNotification']]);

        $this->middleware('permission:upload-sample-list|upload-sample-delete', ['only' => ['index']]);
        $this->middleware('permission:upload-sample-delete', ['only' => ['deleteUpload']]);

        $this->middleware('permission:student-research-project-list|student-research-project-create', ['only' => ['index','addStudentResearchData']]);
        $this->middleware('permission:student-research-project-create', ['only' => ['addStudentResearch','addStudentResearchData']]);
    }

    public function index()
    {
        $roles = Role::get();
        return view('cms.user-management.roles.index', compact('roles'));
    }

    public function addRole()
    {
        $permissions = Permission::all();
        return view('cms.user-management.roles.add',compact('permissions'));
    }

    public function addRoleData()
    {
        request()->validate([
            'role_name' => 'required|max:255|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'in:'.implode(',',Permission::pluck('id')->toArray())
        ]);

        $role = Role::create([
            'name' => strtolower(request()->role_name),
        ]);

        $role->givePermissionTo(request()->permissions);

        return redirect('/admin/manage-roles')->with('success','Role successfully added.');
    }

    public function updateRole($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::all();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$roleId)
            ->pluck('role_has_permissions.permission_id')
            ->all();
        return view('cms.user-management.roles.update',compact('role','permissions','rolePermissions'));
    }

    public function updateRoleData($roleId)
    {
        $role = Role::findOrFail($roleId);

        request()->validate([
            'role_name' => 'required|max:255|unique:roles,name,'.$roleId,
            'permissions' => 'required|array',
            'permissions.*' => 'in:'.implode(',',Permission::pluck('id')->toArray())
        ]);


        $role->update([
            'name' => strtolower(request()->role_name),
        ]);

        $role->syncPermissions(request()->permissions);

        return redirect('/admin/manage-roles')->with('success','Role successfully updated.');
    }

    public function deleteRole($roleId){
        $msg = 'Something went wrong.';
        $code = 400;
        $role = Role::findOrFail($roleId);

        if (!empty($role)) {
            $role->delete();
            $msg = "Successfully Delete record!";
            $code = 200;
        }
        return response()->json(['msg' => $msg], $code);
    }
}
