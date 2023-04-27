@extends('admin.includes.master', ['breadcrumb_title' => 'Staff Show'])

@section('content-area')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Father Name</th>
                                <th>Address</th>
                                <th>Adhaar Image</th>
                                <th>Last Qualification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($manager_data as $userdata)
                            <tr>
                                <td>{{$loop->index+1??''}}</td>
                                <td data-field="name">{{$userdata->managers->name}}</td>
                                <td data-field="name">{{$userdata->managers->email}}</td>
                                <td data-field="name">{{$userdata->managers->mobile}}</td>
                                <td data-field="name">{{$userdata->father_name}}</td>
                                <td data-field="name">{{$userdata->address}}</td>
                                <td data-field="name"><img src="{{ asset($userdata->aadhar_image) }}"
                                        class="rounded-circle"  width="50px" height="50px" alt=""></td>
                                <td data-field="name"><img class="rounded-circle" src="{{ asset($userdata->last_qualification) }}"
                                         alt="" width="50px" height="50px"></td>
                                <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="{{ route('admin.staff.destroy',$userdata->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm edit fas fa-trash" title="Delete">
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('admin.staff.edit',$userdata->id)}}"
                                            class="btn btn-outline-secondary btn-sm edit fas fa-pencil-alt" title="Edit">
                                        </a>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div>

@endsection