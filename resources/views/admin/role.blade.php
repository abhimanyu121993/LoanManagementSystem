@extends('admin.includes.master', ['breadcrumb_title' => isset($editroles)?'Update Role':'Role'])
@section('title', isset($editroles)?'Update Role':'Role')
@section('style-area')

@endsection
@section('content-area')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{isset($editroles)?'Update Role Form':'Role Form'}}</h4>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{isset($editroles)? route('admin.roleUpdate',$editroles->id):route('admin.roleStore')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-role-input" class="form-label">Role</label>
                                <input type="text" class="form-control" id="formrow-role-input" placeholder="Enter Your Role" name="role" value="{{$editroles->name ??''}}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">{{isset($editroles)? 'update':'submit'}}</button>
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

                <h4 class="card-title">{{isset($editroles)?'Update Role Manage':'Role Manage'}}</h4>
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Sr.no.</th>
                            <th>Name</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($roles as $role )
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->created_at}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class=" dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="color:black;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>
                                    @php
                                    $bid=Crypt::encrypt($role->id);
                                    @endphp
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('admin.roleEdit',$bid)}}">Edit</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{route('admin.roleDelete',$bid)}}">Delete</a></li>
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