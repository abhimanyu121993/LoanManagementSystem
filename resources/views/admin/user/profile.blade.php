@extends('admin.includes.master', ['breadcrumb_title' => 'Update Profile'])
@section('title', 'Update Profile')
@section('style-area')

@endsection
@section('content-area')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Update Profile Form</h4>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('admin.userUpdate',$editprofile->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-name-input" class="form-label">Name</label>
                                <input type="text" class="form-control" id="formrow-name-input" placeholder="Enter Your Name" name="name" value="{{$editprofile->name ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-email-input" class="form-label">Email</label>
                                <input type="email" class="form-control" id="formrow-email-input" placeholder="Enter Your Email" name="email" value="{{$editprofile->email ?? ''}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-mobile-input" class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="formrow-mobile-input" placeholder="Enter Your Mobile" name="mobile" value="{{$editprofile->mobile ?? ''}}">
                            </div>
                        </div>
                        <div class="col-lg-6" hidden>
                            <div class="mb-3">
                                <label class="form-label">Role Select</label>
                                <select class="form-control select2 roles" name="roles">
                                    <option selected disabled hidden>--Select Role--</option>
                                    <optgroup label="Roles">
                                        @foreach ($roles as $role)
                                        <option value="{{$role->id}}" {{isset($editprofile)?($editprofile->roles[0]->id == $role->id ?'selected':''):''}}>
                                            {{$role->name ?? ''}}
                                        </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if(isset($editprofile))
                            <img src="{{asset($editprofile->image)}}" alt="" height="50px" width="50px">
                            @endif
                            <div class="mb-3">
                                <label for="formrow-pic-input" class="form-label">Image</label>
                                <input type="file" class="form-control" id="formrow-pic-input" placeholder="Enter Your Pic" name="image" value="">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
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

@endsection
@section('script-area')

@endsection