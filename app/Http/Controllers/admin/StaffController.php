<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\Staff;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.staff.staff_register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $manager_data = Staff::all();
        return view('admin.staff.staff_show',compact('manager_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            'address' => 'required',
        ]);
        try {
            if 
            ($request->hasFile('qualification_document')) {
                $uimg = 'user-' . time() . '-' . rand(0, 99) . '.' . $request->qualification_document->extension();
                $request->qualification_document->move(public_path('upload/staff/document/'), $uimg);
                $user_pic = 'upload/staff/document/' . $uimg;
            }
           
            if 
            ($request->hasFile('adhaar_image')) {
                $adhaar_img = 'adhaar-' . time() . '-' . rand(0, 99) . '.' . $request->adhaar_image->extension();
                $request->adhaar_image->move(public_path('upload/staff/adhaar/'), $adhaar_img);
                $adhaar = 'upload/staff/adhaar/' . $adhaar_img;
            }

            if 
            ($request->hasFile('last_image')) {
                $last_img = 'last-' . time() . '-' . rand(0, 99) . '.' . $request->last_image->extension();
                $request->last_image->move(public_path('upload/staff/last_quali/'), $last_img);
                $last_image = 'upload/staff/last_quali/' . $last_img;
            }
            $user = User::create([
                'name' => $request->fname.' '.$request->lname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
                'created_id' => Auth::id(),
            ]);
            
             Staff::create([
                'father_name' => $request->father_name,
                'user_id' => $user->id,
                'Qualification_document' => $user_pic,
                'aadhar_image' => $adhaar,
                'last_qualification' => $last_image,
                'address' => $request->address,
            ]);
            
            if (isset($user)) {
                $user->assignRole('manager');
                return redirect()->back()->with('toast_success', 'Staff registerd successfully !');
            } else {
                return redirect()->back()->with('toast_error', 'Staff not register successfully !');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         
        try {
            $edituser = Staff::find($id);
            $users = Staff::find($id);
            $roles = Role::all();
            return view('admin.staff.staff_register', compact('edituser', 'users', 'roles'));
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
                $oldpic = Staff::find($id);
                $pic = $oldpic->qualification_document;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'user-' . time() . '-' . rand(0, 99) . '.' . $request->qualification_document->extension();
                $request->qualification_document->move(public_path('upload/staff/document/'), $uimg);
                $user_pic = 'upload/staff/document/' . $uimg;
                Staff::find($id)->update(['qualification_document' => $user_pic]);
            }
            if($request->hasFile('adhaar_image')) {
                $oldpic = Staff::find($id);
                $pic = $oldpic->adhaar_image;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'adhaar-' . time() . '-' . rand(0, 99) . '.' . $request->adhaar_image->extension();
                $request->adhaar_image->move(public_path('upload/staff/adhaar/'), $uimg);
                $user_pic = 'upload/staff/adhaar/' . $uimg;
                Staff::find($id)->update(['aadhar_image' => $user_pic]);
                
            }
            if ($request->hasFile('last_image')) {
                $oldpic = Staff::find($id);
                $pic = $oldpic->last_image;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'last-' . time() . '-' . rand(0, 99) . '.' . $request->last_image->extension();
                $request->last_image->move(public_path('upload/staff/last_quali/'), $uimg);
                $user_pic = 'upload/staff/last_quali/' . $uimg;
                Staff::find($id)->update(['last_qualification' => $user_pic]);
            }
            $user = User::find(Staff::find($id)->user_id)->update([
                'name' => $request->fname.' '.$request->lname,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
            ]);
            Staff::find($id)->update([
                'father_name' => $request->father_name,
                'address' => $request->address,
            ]);
            if (isset($user)) {
                User::find($id)->syncRoles($request->roles);
                return redirect()->back()->with('toast_success', 'Staff updated successfully !');
            } else {
                return redirect()->back()->with('toast_error', 'Staff not update successfully !');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('toast_error', 'Server Error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Staff::destroy($id);
            return redirect()->back()->with('toast_success', 'Staff deleted succesfully!');
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('toast_error', 'Something Went Wrong!');
        }
    }
}
