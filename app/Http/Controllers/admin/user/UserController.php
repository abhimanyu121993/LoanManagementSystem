<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function userRegister()
    {
        try {
            if (Auth::user()->hasRole('admin')) {
                $users = User::all();
                $roles = Role::all();
            } else {
                // dd();
                $users = User::where('created_id', Auth::user()->id)->get();
                $roles = Role::all();
            }
            return view('admin.user.user_register', compact('roles', 'users'));
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'roles' => 'required',
            'password' => 'required',
            'image' => 'nullable|image'
        ]);

        try {

            $user_pic = '';
            if ($request->hasFile('image')) {
                $uimg = 'user-' . time() . '-' . rand(0, 99) . '.' . $request->image->extension();
                $request->image->move(public_path('upload/user/'), $uimg);
                $user_pic = 'upload/user/' . $uimg;
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
                'image' => $user_pic,
                'created_id' => Auth::user()->id,
            ]);
            if (isset($user)) {
                $user->assignRole($request->roles);
                return redirect()->back()->with('success', 'User registerd successfully !');
            } else {
                return redirect()->back()->with('error', 'User not register successfully !');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function userEdit($id)
    {
        try {

            $id = Crypt::decrypt($id);
            $edituser = User::find($id);
            $users = User::all();
            $roles = Role::all();
            return view('admin.user.user_register', compact('edituser', 'users', 'roles'));
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function userUpdate(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'roles' => 'required',
        ]);

        try {

            if ($request->hasFile('image')) {
                $oldpic = User::find($id);
                $pic = $oldpic->image;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'user-' . time() . '-' . rand(0, 99) . '.' . $request->image->extension();
                $request->image->move(public_path('upload/user/'), $uimg);
                $user_pic = 'upload/user/' . $uimg;
                $user = User::find($id)->update(['image' => $user_pic]);
            }

            $user = User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
            ]);
            if (isset($user)) {
                User::find($id)->syncRoles($request->roles);
                return redirect()->back()->with('success', 'User updated successfully !');
            } else {
                return redirect()->back()->with('error', 'User not update successfully !');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function userDelete($id)
    {
        try {

            $id = Crypt::decrypt($id);
            $img = User::find($id);
            $pic = $img->image;
            if ($pic != '') {
                $del = File::delete(public_path($pic));
            }
            $delete = User::find($id)->delete();
            if (isset($delete)) {

                return redirect()->back()->with('success', 'User deleted successfully !');
            } else {
                return redirect()->back()->with('error', 'User not delete successfully !');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function profile($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $editprofile = User::find($id);
            $roles = Role::all();
            return view('admin.user.profile', compact('roles', 'editprofile'));
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function password($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $editpassword = User::find($id);
            return view('admin.user.password', compact('editpassword'));
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function passwordUpdate(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'con_password' => 'required_with:password|same:new_password',
        ]);
        try {

            if (Hash::check($request->old_password, Auth::user()->password)) {
                User::find(Auth::user()->id)->update([
                    'password' => Hash::make($request->new_password),
                ]);
                return redirect()->back()->with('success', 'Password Update uccessfully !');
            } else {
                return redirect()->back()->with('success', 'Invalid Password');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }
}
