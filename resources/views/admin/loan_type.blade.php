@extends('admin.includes.master', ['breadcrumb_title' => 'Loan Type'])

@section('content-area')
<div class="card">
<form action="{{isset($data)?route('admin.loan-type.update',$data->id):route('admin.loan-type.store')}}" method="post" enctype="multipart/form-data">
@isset($data)
@method('PUT')
@endisset
@csrf
    <div class="card-body bordered row">
    <label class="form-label">Enter Loan Type</label>
    <div class="col-md-10">
            <div class="mb-3">
            <input type="text" class="form-control" placeholder="Enter Your Loan Type"
                    name="loan_type" value="{{$data->loan_type??''}}">
            </div>
        </div>
        <div class="col-md-2">
            <div class="mb-3">
        <button type="submit" class="btn btn-primary w-md">Submit</button>
            </div>
        </div>
    </div>
</form>
</div>
@isset($loan_types)
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
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($loan_types as $loan)
                                                    <tr>
                                                        <td>{{$loop->index+1??''}}</td>
                                                        <td data-field="name">{{$loan->loan_type??''}}</td>
                                                        <td data-field="age">
                                                            <input type="checkbox" data-id="{{$loan->id}}" class="toggle-class switch" id="switch{{$loop->index}}" switch="none" {{$loan->status == '1'?'checked':''}} />
                                                            <label for="switch{{$loop->index}}" data-on-label="On" data-off-label="Off"></label></td>
                                                        <td style="width: 100px">
                                                            <a href="{{route('admin.loan-type.edit',$loan->id)}}" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <a   href="{{route('admin.loan-type.destroy',$loan->id)}}" class="btn btn-outline-danger btn-sm edit" title="Edit">
                                                                <i class="fas fa-trash"></i>
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
                        @endisset
@endsection
