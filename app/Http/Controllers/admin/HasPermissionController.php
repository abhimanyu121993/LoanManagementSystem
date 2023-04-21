<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\PermissionName;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HasPermissionController extends Controller
{
    public function hasPermission()
    {

        try {
            $roles = Role::all();
            return view('admin.has_permission', compact('roles'));
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function rolePermissionFatch(Request $request)
    {
        $request->validate([
            'roles' => 'required',
        ]);

        try {
            $selectroles = Role::find($request->roles);
            $haspermission = Permission::all();
            $haspermissionname = PermissionName::all();
            return view('admin.fatch_permission', compact('selectroles', 'haspermission', 'haspermissionname'));
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function assingPermission(Request $request)
    {
        $request->validate([
            'roleid' => 'required|exists:roles,id',
            'rolepermissions' => 'required|array',
        ]);

        try {
            $role = Role::find($request->roleid);
            $role->syncPermissions($request->rolepermissions);
            return redirect()->route('admin.hasPermission')->with('success', 'Permission Assigned Successfully');
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }
}
