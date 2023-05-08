@extends('admin.includes.master', ['breadcrumb_title' => isset($editpermission)?'Update Permission':'Permission'])
@section('title', isset($editpermission)?'Update Permission':'Permission')
@section('style-area')

@endsection
@section('content-area')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{isset($editpermission)?'Update Permission Form':'Permission Form'}}</h4>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{isset($editpermission)? route('admin.permissionUpdate',$editpermission->id):route('admin.permissionStore')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-permission-input" class="form-label">Permission</label>
                                <input type="text" class="form-control" id="formrow-role-input" placeholder="Enter Your Permission" name="permission" value="{{$editpermission->name ??''}}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">{{isset($editpermission)? 'update':'submit'}}</button>
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

                <h4 class="card-title">{{isset($editpermission)?'Update Permission Manage':'Permission Manage'}}</h4>
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Sr.no.</th>
                            <th>Name</th>
                            <th>Created_at</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($permissionsnames as $permissionsname )
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$permissionsname->name}}</td>
                            <td>{{$permissionsname->created_at}}</td>
                            <!-- <td>
                                <div class="dropdown">
                                    <a class=" dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="color:black;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                    @php
                                    $bid=Crypt::encrypt($permissionsname->id);
                                    @endphp
                                    <ul class="dropdown-menu">

                                        <li><a class="dropdown-item" href="{{route('admin.permissionEdit',$bid)}}">Edit</a>
                                        </li>



                                        <li><a class="dropdown-item" href="{{route('admin.permissionDelete',$bid)}}">Delete</a></li>


                                    </ul>
                                </div>
                            </td> -->
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