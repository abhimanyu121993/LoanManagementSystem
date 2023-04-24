@extends('admin.includes.master', ['breadcrumb_title' => isset($edituser)?'Update Manager':'Manager'])
@section('title', isset($edituser)?'Update Manager':'Manager')
@section('style-area')

@endsection
@section('content-area')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{isset($edituser)?'Update Manager Form':'Manager Form'}}</h4>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{isset($edituser)? route('admin.userUpdate',$edituser->id):route('admin.userStore')}}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-name-input" class="form-label">First_Name</label>
                                <input type="text" class="form-control" id="formrow-name-input"
                                    placeholder="Enter Your First Name" name="fname" value="{{$edituser->name ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-name-input" class="form-label">Last_Name</label>
                                <input type="text" class="form-control" id="formrow-name-input"
                                    placeholder="Enter Your Last Name" name="lname" value="{{$edituser->name ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Email</label>
                                <input type="email" class="form-control" id="formrow-email-input"
                                    placeholder="Enter Your Email" name="email" value="{{$edituser->email ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-mobile-input" class="form-label">Father Name</label>
                                <input type="text" class="form-control" id="formrow-mobile-input"
                                    placeholder="Enter Your Father Name" name="father_name" value="{{$edituser->mobile ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-mobile-input" class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="formrow-mobile-input"
                                    placeholder="Enter Your Mobile" name="mobile" value="{{$edituser->mobile ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4 {{isset($edituser)? 'd-none':''}}">
                            <div class="mb-3">
                                <label for="formrow-password-input" class="form-label">Paasword</label>
                                <input type="password" class="form-control" id="formrow-password-input"
                                    placeholder="Enter Your Password" name="password" value="">
                            </div>
                        </div>

                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($edituser->image)}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Qualification(document)</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                    placeholder="Enter Your Pic" name="image" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($edituser->image)}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Aadhar(image)</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                    placeholder="Enter Your Pic" name="image" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($edituser->image)}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Last Qualification(document)</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                    placeholder="Enter Your Pic" name="image" value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <label for="floatingTextarea">Address</label>
                                <textarea class="form-control" name="address" placeholder="Enter your address here" id="floatingTextarea"></textarea>
                              </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="btn btn-primary w-md">{{isset($edituser)? 'update':'submit'}}</button>
                    </div>

                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">{{isset($edituser)?'Update User Manage':'User Manage'}}</h4>
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Sr.no.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($users as $user )
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td><img src="{{asset($user->image)}}" alt="" height="50px" width="50px"></td>
                            <td>{{$user->name ??''}}</td>
                            <td>{{$user->email ??''}}</td>
                            <td>{{$user->mobile ?? ''}}</td>

                            <td>

                                <div class="dropdown">
                                    <a class=" dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false"
                                        style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            style="color:black;" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-more-horizontal">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                    @php
                                    $bid=Crypt::encrypt($user->id);
                                    @endphp

                                    <ul class="dropdown-menu">

                                        <li><a class="dropdown-item" href="{{route('admin.userEdit',$bid)}}">Edit</a>
                                        </li>

                                        <li><a class="dropdown-item"
                                                href="{{route('admin.userDelete',$bid)}}">Delete</a></li>

                                    </ul>

                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@section('script-area')

@endsection
