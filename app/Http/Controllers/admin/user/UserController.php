<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\Manager;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{
    public function userRegister()
    {
        $roles = Role::get();
        return view('admin.user.user_register',compact('roles'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'father_name' => 'required',
            'password' => 'required',
            'qualification_document' => 'required',
            'adhaar_image' => 'required',
            'last_image' => 'required',
            'bank_experience' => 'required',
            'address' => 'required',
        ]);
        try {
            if
            ($request->hasFile('qualification_document')) {
                $uimg = 'user-' . time() . '-' . rand(0, 99) . '.' . $request->qualification_document->extension();
                $request->qualification_document->move(public_path('upload/user/'), $uimg);
                $user_pic = 'upload/user/' . $uimg;
            }

            if
            ($request->hasFile('adhaar_image')) {
                $adhaar_img = 'adhaar-' . time() . '-' . rand(0, 99) . '.' . $request->adhaar_image->extension();
                $request->adhaar_image->move(public_path('upload/adhaar/'), $adhaar_img);
                $adhaar = 'upload/adhaar/' . $adhaar_img;
            }

            if
            ($request->hasFile('last_image')) {
                $last_img = 'last-' . time() . '-' . rand(0, 99) . '.' . $request->last_image->extension();
                $request->last_image->move(public_path('upload/last_quali/'), $last_img);
                $last_image = 'upload/last_quali/' . $last_img;
            }

            $user = User::create([
                'name' => $request->fname.' '.$request->lname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
                'created_id' => Auth::id(),
            ]);

            $manager = Manager::create([
                'father_name' => $request->father_name,
                'user_id' => $user->id,
                'Qualification_document' => $user_pic,
                'aadhar_image' => $adhaar,
                'last_qualification' => $last_image,
                'address' => $request->address,
                'bank_experience' => $request->bank_experience,
            ]);

            if (isset($manager)) {
                $user->assignRole('manager');
                return redirect()->back()->with('toast_success', 'Manager registerd successfully !');
            } else {
                return redirect()->back()->with('toast_error', 'Manager not register successfully !');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('toast_error', 'Server Error');
        }
    }

    public function userEdit($id)
    {

        try {
            $edituser = Manager::find($id);
            $users = Manager::find($id);
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
            'fname' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'father_name' => 'required',
            'password' => 'required',
            'address' => 'required',
        ]);

        try {
            if ($request->hasFile('qualification_document')) {
                $oldpic = Manager::find($id);
                $pic = $oldpic->qualification_document;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'user-' . time() . '-' . rand(0, 99) . '.' . $request->qualification_document->extension();
                $request->qualification_document->move(public_path('upload/user/'), $uimg);
                $user_pic = 'upload/user/' . $uimg;
                Manager::find($id)->update(['qualification_document' => $user_pic]);
            }
            if($request->hasFile('adhaar_image')) {
                $oldpic = Manager::find($id);
                $pic = $oldpic->adhaar_image;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'adhaar-' . time() . '-' . rand(0, 99) . '.' . $request->adhaar_image->extension();
                $request->adhaar_image->move(public_path('upload/adhaar/'), $uimg);
                $user_pic = 'upload/adhaar/' . $uimg;
                Manager::find($id)->update(['aadhar_image' => $user_pic]);

            }
            if ($request->hasFile('last_image')) {
                $oldpic = Manager::find($id);
                $pic = $oldpic->last_image;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'last-' . time() . '-' . rand(0, 99) . '.' . $request->last_image->extension();
                $request->last_image->move(public_path('upload/last_quali/'), $uimg);
                $user_pic = 'upload/last_quali/' . $uimg;
                Manager::find($id)->update(['last_qualification' => $user_pic]);
            }
            $user = User::find(Manager::find($id)->user_id)->update([
                'name' => $request->fname.' '.$request->lname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
            ]);
            Manager::find($id)->update([
                'father_name' => $request->father_name,
                'address' => $request->address,
                'bank_experience' => $request->bank_experience,
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
                Manager::find($id)->delete();
                $delete = User::find($id)->delete();
                if (isset($delete)) {
                    return redirect()->back()->with('success', 'User deleted successfully !');
                } else {
                    return redirect()->back()->with('error', 'User not delete successfully !');
                }
        }catch (Exception $ex) {

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
    public function managers()
    {
        $manager_data = Manager::all();
        return view('admin.managers.manager',compact('manager_data'));
    }
    public function managerDelete($id)
    {
        try {
            Manager::find($id)->delete();
            return redirect()->back()->with('toast_success', 'Loan type deleted succesfully!');
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('toast_error', 'Something Went Wrong!');
        }
    }

}
