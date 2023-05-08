@extends('admin.includes.master', ['breadcrumb_title' => isset($edituser)?'Update Staff':'Staff'])
@section('title', isset($edituser)?'Update Staff':'Staff')
@section('style-area')

@endsection
@section('content-area')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{isset($edituser)?'Update Staff Form':'Staff Form'}}</h4>
                <form
                    action="{{isset($edituser)? route('admin.staff.update',$edituser->id):route('admin.staff.store')}}"
                    method="post" enctype="multipart/form-data">
                    @isset($edituser)
                    @method('PUT')
                    @endisset
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-name-input" class="form-label">First_Name</label>
                                <input type="text" class="form-control" id="formrow-name-input"
                                    placeholder="Enter Your First Name" name="fname"
                                    value="{{$users->user_name[0] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-name-input" class="form-label">Last_Name</label>
                                <input type="text" class="form-control" id="formrow-name-input"
                                    placeholder="Enter Your Last Name" name="lname"
                                    value="{{$users->user_name[1] ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Email</label>
                                <input type="email" class="form-control" id="formrow-email-input"
                                    placeholder="Enter Your Email" name="email"
                                    value="{{$users->managers->email ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-mobile-input" class="form-label">Father Name</label>
                                <input type="text" class="form-control" id="formrow-mobile-input"
                                    placeholder="Enter Your Father Name" name="father_name"
                                    value="{{$users->father_name ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-mobile-input" class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="formrow-mobile-input"
                                    placeholder="Enter Your Mobile" name="mobile"
                                    value="{{$users->managers->mobile ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-password-input" class="form-label">Paasword</label>
                                <input type="password" class="form-control" id="formrow-password-input"
                                    placeholder="Enter Your Password" name="password"
                                    value="{{$users->managers->password ??''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($users->qualification_document ??'')}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Qualification(document)</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                    placeholder="Enter Your Pic" name="qualification_document"
                                    value="{{$users->qualification_document ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($users->aadhar_image??'')}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Aadhar(image)</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                    placeholder="Enter Your Pic" name="adhaar_image"
                                    value="{{$users->aadhar_image ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if(isset($edituser))
                            <img src="{{asset($users->last_qualification ??'')}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Last Qualification(document)</label>
                                <input type="file" class="form-control" id="formrow-pic-input"
                                    placeholder="Enter Your Pic" name="last_image"
                                    value="{{$users->last_qualification ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <label for="floatingTextarea">Address</label>
                                <textarea class="form-control" name="address" placeholder="Enter your address here"
                                    id="floatingTextarea">{{$users->address ?? ''}}</textarea>
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

{{--<div class="row">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="color:black;"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </a>
                    @php
                    $bid=Crypt::encrypt($user->id);
                    @endphp

                    <ul class="dropdown-menu">
                        @can('staff_edit')
                        <li><a class="dropdown-item" href="{{route('admin.userEdit',$bid)}}">Edit</a>
                        </li>
                        @endcan
                        @can('staff_delete')
                        <li><a class="dropdown-item" href="{{route('admin.userDelete',$bid)}}">Delete</a></li>
                        @endcan
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
</div> --}}
@endsection
@section('script-area')

@endsection