<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\LoanType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class LoantypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $loan_types = LoanType::all();
        return view('admin.loan_type',compact('loan_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request ->validate([
            'loan_type' => 'required',
        ]);
        LoanType::create([
            'loan_type' => $request->loan_type,
        ]);
        return redirect()->back()->with('toast_success', 'Loan Type Added Successfully !');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            LoanType::destroy($id);
            return redirect()->back()->with('toast_success', 'Loan type deleted succesfully!');
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('toast_error', 'Something Went Wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $data = LoanType::find($id);
       return view('admin.loan_type',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request ->validate([
            'loan_type' => 'required',
        ]);
        LoanType::find($id)->update([
            'loan_type' => $request->loan_type,
        ]);
        return redirect()->route('admin.loan-type.index')->with('toast_success', 'Loan Type updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
      //
    }

    public function status($id)
    {
       $data = LoanType::find($id)->status;
       LoanType::find($id)->update([
        'status'=> $data == 1?0:1
       ]);

       return "status updated successfully!";
    }
}
