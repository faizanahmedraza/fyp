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
