@extends('admin.includes.master', ['breadcrumb_title' => 'Manager Show'])

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
                                <th>Bank Experience</th>
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
                                <td data-field="name">{{$userdata->bank_experience}}</td>
                                <td data-field="name">{{$userdata->address}}</td>
                                <td data-field="name"><img src="{{ asset($userdata->aadhar_image) }}"
                                        style="height:50px;text-align:center;width:50px;border-radius:50%;" alt=""></td>
                                <td data-field="name"><img src="{{ asset($userdata->last_qualification) }}"
                                        style="height:50px;text-align:center;width:50px;border-radius:50%;" alt=""></td>
                                <td style="width: 100px">
                                    <a href="{{ route('admin.userDelete',$userdata->id) }}"
                                        class="btn btn-outline-danger btn-sm edit" title="Edit">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{route('admin.userEdit',$userdata->id)}}"
                                        class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
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