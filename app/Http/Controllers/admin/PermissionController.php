<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\PermissionName;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function permission()
    {

        try {

            $permissionsnames = PermissionName::all();
            return view('admin.permission', compact('permissionsnames'));
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function permissionStore(Request $request)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        try {

            $permission = PermissionName::create(['name' => $request->permission]);
            Permission::create(['name' => $request->permission, 'perm_id' => $permission->id]);
            Permission::create(['name' => $request->permission . '_create', 'perm_id' => $permission->id]);
            Permission::create(['name' => $request->permission . '_edit', 'perm_id' => $permission->id]);
            Permission::create(['name' => $request->permission . '_delete', 'perm_id' => $permission->id]);
            Permission::create(['name' => $request->permission . '_read', 'perm_id' => $permission->id]);
            if ($permission) {
                return redirect()->back()->with('success', 'Permission Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Permission Not Add Successfully');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function permissionEdit($id)
    {

        try {

            $id = Crypt::decrypt($id);
            $permissionsnames = PermissionName::all();
            $editpermission = PermissionName::find($id);
            return view('admin.permission', compact('editpermission', 'permissionsnames'));
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function permissionUpdate(Request $request, $id)
    {

        $request->validate([
            'permission' => 'required'
        ]);

        try {

            $permission = PermissionName::find($id)->update(['name' => $request->permission]);
            $data = Permission::where('perm_id', $id)->delete();
            if (isset($data)) {
                Permission::create(['name' => $request->permission, 'perm_id' => $id]);
                Permission::create(['name' => $request->permission . '_create', 'perm_id' => $id]);
                Permission::create(['name' => $request->permission . '_edit', 'perm_id' => $id]);
                Permission::create(['name' => $request->permission . '_delete', 'perm_id' => $id]);
                Permission::create(['name' => $request->permission . '_read', 'perm_id' => $id]);
                if ($permission) {
                    return redirect()->back()->with('success', 'Permission Added Successfully');
                } else {
                    return redirect()->back()->with('error', 'Permission Not Add Successfully');
                }
            } else {
                return redirect()->back()->with('error', 'Permission Not Add Successfully');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function permissionDelete($id)
    {

        try {

            $id = Crypt::decrypt($id);
            $permission = PermissionName::find($id)->delete();
            if (isset($permission)) {
                $data = Permission::where('perm_id', $id)->delete();
                if ($data) {
                    return redirect()->back()->with('success', 'Permission Deleted Successfully');
                } else {
                    return redirect()->back()->with('error', 'Permission Not Delete Successfully');
                }
            } else {
                return redirect()->back()->with('error', 'Permission Not Delete Successfully');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function getPermission()
    {

        try {

            return

                $permission = Auth::user()->getPermissionsViaRoles();
            return response()->json([
                'data' => $permission,
                'message' => 'All Permission Dispaly !',
                'status' => 200,
                'error' => NULL
            ]);
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return response()->json([
                'status' => 305,
                'error' => 'Server Error'
            ]);
        }
    }
}
