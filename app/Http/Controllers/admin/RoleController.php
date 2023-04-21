<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function role()
    {
        try {

            $roles = Role::all();
            return view('admin.role', compact('roles'));
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function roleStore(Request $request)
    {
        $request->validate([
            'role' => 'required',
        ]);

        try {

            $roles = Role::create([
                'name' => $request->role,
            ]);
            if ($roles) {
                return redirect()->back()->with('success', 'Role Created Successfully !');
            } else {
                return redirect()->back()->with('error', 'Role not Create Successfully !');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }
    public function roleEdit($id)
    {
        try {

            $id = Crypt::decrypt($id);
            $editroles = Role::find($id);
            $roles = Role::all();
            return view('admin.role', compact('roles', 'editroles'));
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function roleUpdate(Request $request, $id)
    {
        $request->validate([
            'role' => 'required',
        ]);

        try {

            $roles = Role::find($id)->update([
                'name' => $request->role,
            ]);
            if ($roles) {
                return redirect()->back()->with('success', 'Role Updated Successfully !');
            } else {
                return redirect()->back()->with('error', 'Role not Update Successfully !');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function roleDelete($id)
    {
        try {

            $id = Crypt::decrypt($id);
            $roles = Role::find($id)->delete();
            if ($roles) {
                return redirect()->back()->with('success', 'Role Deleted Successfully !');
            } else {
                return redirect()->back()->with('error', 'Role not Delete Successfully !');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }
}
