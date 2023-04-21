@extends('admin.includes.master', ['breadcrumb_title' => 'Update Password'])
@section('title', 'Update Password')
@section('style-area')

@endsection
@section('content-area')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Update Password Form</h4>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('admin.passwordUpdate',$editpassword->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Old Password</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" name="old_password">
                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon1" name="new_password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Conform Password</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon2" name="con_password">
                                </div>
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