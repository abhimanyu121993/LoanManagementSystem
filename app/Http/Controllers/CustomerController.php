<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Error;
use App\Models\LoanType;
use App\Models\Staff;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(Auth::user()->hasRole('staff') == 'staff'){
            $customer_data = Customer::where('created_id',Auth::id())->get();
            $data = LoanType::all();
            return view('admin.customer.customer_show', compact('customer_data', 'data'));
        }
        else{
            $customer_data = Customer::get();
            $data = LoanType::all();
            return view('admin.customer.customer_show', compact('customer_data', 'data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = LoanType::all();
        return view('admin.customer.customer_create', compact('data'));
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
            'buisness_name' => 'required',
            'adhaar_image' => 'required',
            'pancard_image' => 'required',
            'bank_statement' => 'required',
            'bank_passbook' => 'required',
            'customer_image' => 'required',
            'visit_pic' => 'required',
            'itr' => 'required',
            'gst' => 'required',
            'loan_type' => 'required',
            'address' => 'required',
        ]);
        try {
            $user = Customer::create([
                'name' => $request->fname . ' ' . $request->lname,
                'email' => $request->email,
                'phone' => $request->mobile,
                'buisness_name' => $request->buisness_name,
                'aadhar_image' => $request->hasFile('adhaar_image') ? Helper::ImageInsert($request->adhaar_image, 'customer/adhaar_image/', 'adhaar_image') : '',
                'pancard_image' => $request->hasFile('pancard_image') ? Helper::ImageInsert($request->pancard_image, 'customer/pancard/', 'pancard') : '',
                'bank_statement' => $request->hasFile('bank_statement') ? Helper::ImageInsert($request->bank_statement, 'customer/bank_statement/', 'bank_statement') : '',
                'bank_passbook' => $request->hasFile('bank_passbook') ? Helper::ImageInsert($request->bank_passbook, 'customer/bank_passbook/', 'bank_passbook') : '',
                'customer_image' => $request->hasFile('customer_image') ? Helper::ImageInsert($request->customer_image, 'customer/customer_image/', 'customer_image') : '',
                'visit_pic' => $request->hasFile('visit_pic') ? Helper::ImageInsert($request->visit_pic, 'customer/visit_pic/', 'visit_pic') : '',
                'itr' => $request->itr,
                'gst' => $request->gst,
                'loan_type' => $request->loan_type,
                'address' => $request->address,
                'created_id' => Auth::id(),

            ]);
            if (isset($user)) {
                return redirect()->back()->with('toast_success', 'Customer registerd successfully !');
            } else {
                return redirect()->back()->with('toast_error', 'Customer not register successfully !');
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
    public function edit(string $id)
    {
        try {
            $edituser = Customer::find($id);
            $users = Customer::find($id);
            $roles = Role::all();
            $data = LoanType::all();
            return view('admin.customer.customer_create', compact('edituser', 'users', 'roles', 'data'));
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
            'lname' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'loan_type' => 'required',
            'address' => 'required',
        ]);

        try {
            if ($request->hasFile('pancard_image')) {
                $oldpic = Customer::find($id);
                $pic = $oldpic->pancard_image;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'user-' . time() . '-' . rand(0, 99) . '.' . $request->pancard_image->extension();
                $request->pancard_image->move(public_path('upload/customer/pancard/'), $uimg);
                $user_pic = 'upload/staff/document/' . $uimg;
                Customer::find($id)->update(['upload/customer/pancard/' => $user_pic]);
            }
            if ($request->hasFile('adhaar_image')) {
                $oldpic = Customer::find($id);
                $pic = $oldpic->adhaar_image;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'adhaar-' . time() . '-' . rand(0, 99) . '.' . $request->adhaar_image->extension();
                $request->adhaar_image->move(public_path('upload/customer/adhaar/'), $uimg);
                $user_pic = 'upload/customer/adhaar/' . $uimg;
                Customer::find($id)->update(['aadhar_image' => $user_pic]);

            }
            if ($request->hasFile('bank_statement')) {
                $oldpic = Customer::find($id);
                $pic = $oldpic->bank_statement;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'last-' . time() . '-' . rand(0, 99) . '.' . $request->bank_statement->extension();
                $request->bank_statement->move(public_path('upload/customer/bank_statement/'), $uimg);
                $user_pic = 'upload/customer/bank_statement/' . $uimg;
                Customer::find($id)->update(['bank_statement' => $user_pic]);
            }
            if ($request->hasFile('bank_passbook')) {
                $oldpic = Customer::find($id);
                $pic = $oldpic->bank_passbook;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'last-' . time() . '-' . rand(0, 99) . '.' . $request->bank_passbook->extension();
                $request->bank_passbook->move(public_path('upload/customer/bank_passbook/'), $uimg);
                $user_pic = 'upload/customer/bank_passbook/' . $uimg;
                Customer::find($id)->update(['bank_passbook' => $user_pic]);
            }
            if ($request->hasFile('customer_image')) {
                $oldpic = Customer::find($id);
                $pic = $oldpic->customer_image;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'last-' . time() . '-' . rand(0, 99) . '.' . $request->customer_image->extension();
                $request->customer_image->move(public_path('upload/customer/customer_pic/'), $uimg);
                $user_pic = 'upload/customer/customer_pic/' . $uimg;
                Customer::find($id)->update(['customer_image' => $user_pic]);
            }
            if ($request->hasFile('visit_pic')) {
                $oldpic = Customer::find($id);
                $pic = $oldpic->visit_pic;
                if ($pic != '') {
                    $del = File::delete(public_path($pic));
                }
                $uimg = 'last-' . time() . '-' . rand(0, 99) . '.' . $request->visit_pic->extension();
                $request->visit_pic->move(public_path('upload/customer/visit_pic/'), $uimg);
                $user_pic = 'upload/customer/visit_pic/' . $uimg;
                Customer::find($id)->update(['visit_pic' => $user_pic]);
            }
            $user = Customer::find($id)->update([
                'name' => $request->fname . ' ' . $request->lname,
                'email' => $request->email,
                'phone' => $request->mobile,
                'buisness_name' => $request->buisness_name,
                'itr' => $request->itr,
                'gst' => $request->gst,
                'loan_type' => $request->loan_type,
                'address' => $request->address,
            ]);
            if (isset($user)) {
                return redirect()->back()->with('toast_success', 'Customer updated successfully !');
            } else {
                return redirect()->back()->with('toast_error', 'Customer not update successfully !');
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
    public function destroy(string $id)
    {
        try {
            Customer::destroy($id);
            return redirect()->back()->with('toast_success', 'Staff deleted succesfully!');
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('toast_error', 'Something Went Wrong!');
        }
    }
    public function approval(Request $request)
    {
        $status = Customer::find($request->remark_id)->approved;
        if ($status == 0) {
            Customer::find($request->remark_id)->update([
                'remark' => $request->remark,
                'approved' => 1,
            ]);
            return back()->with('toast_success', 'Approved Successfully!');
        } else {
            Customer::find($request->remark_id)->update([
                'remark' => $request->remark,
                'approved' => 0,
            ]);
            return back()->with('toast_success', 'Disapproved Successfully!');
        }
    }
}
