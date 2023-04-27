@extends('admin.includes.master', ['breadcrumb_title' => 'Create customer'])

@section('content-area')
    <div class="row">
        <div class="col-12">
            <div class="card p-3">
                <h4 class="card-title mb-4">{{isset($edituser)?'Update Form':'Create Form'}}</h4>
                <form action="{{isset($edituser)? route('admin.userUpdate',$edituser->id):route('admin.userStore')}}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-name-input" class="form-label">First_Name</label>
                                <input type="text" class="form-control" id="formrow-name-input"
                                    placeholder="Enter Your First Name" name="fname" value="{{$users->user_name[0] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-name-input" class="form-label">Last_Name</label>
                                <input type="text" class="form-control" id="formrow-name-input"
                                    placeholder="Enter Your Last Name" name="lname" value="{{$users->user_name[1] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Email</label>
                                <input type="email" class="form-control" id="formrow-email-input"
                                    placeholder="Enter Your Email" name="email" value="{{$users->managers->email ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-mobile-input" class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="formrow-mobile-input"
                                    placeholder="Enter Your Mobile" name="mobile" value="{{$users->managers->mobile ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-mobile-input" class="form-label">Customer Buisness Name</label>
                                <input type="text" class="form-control" id="formrow-mobile-input"
                                    placeholder="Enter Your Buisness Name" name="buisness_name" value="{{$users->managers->mobile ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($users->aadhar_image??'')}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Aadhar(image)</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                     name="adhaar_image" value="{{$users->aadhar_image ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($users->aadhar_image??'')}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Pancard(image)</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                     name="pancard_image" value="{{$users->pancard_image ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($users->aadhar_image??'')}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Bank Statement</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                     name="bank_statement" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($users->aadhar_image??'')}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Bank Passbook</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                     name="bank_passbook" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($users->aadhar_image??'')}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Customer(image)</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                     name="customer_photo" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($users->aadhar_image??'')}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Visit Pic</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                     name="visit_pic" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">ITR</label>
                                <input type="text" class="form-control" id="formrow-pic-input"
                                    placeholder="Enter Your ITR" name="itr" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">GST-IN</label>
                                <input type="text" class="form-control" id="formrow-pic-input"
                                    placeholder="Enter Your GST-IN" name="gst" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Loan Type</label>
                                <select name="loan_type" class="form-select" id="">
                                    <option value="">Select Loan Type</option>
                                    @foreach ($data as $loan)
                                    <option value="{{$loan->id}}">{{$loan->loan_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <label for="floatingTextarea">Address</label>
                                <textarea class="form-control" name="address" placeholder="Enter your address here" id="floatingTextarea">{{$users->address ?? ''}}</textarea>
                              </div>
                        </div>

                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">{{isset($edituser)? 'update':'submit'}}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
