@extends('admin.includes.master', ['breadcrumb_title' => 'Customer Show'])

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
                                <th>Buisness Name</th>
                                <th>Adhaar Image</th>
                                <th>Pancard Image</th>
                                <th>Bank Statement</th>
                                <th>Bank Passbook</th>
                                <th>Customer Image</th>
                                <th>Visit Pic</th>
                                <th>ITR</th>
                                <th>GST-IN</th>
                                <th>Loan Type</th>
                                <th>Address</th>
                                <th>Approv</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer_data as $userdata)
                            <tr>
                                <td>{{$loop->index+1??''}}</td>
                                <td data-field="name">{{$userdata->name}}</td>
                                <td data-field="name">{{$userdata->email}}</td>
                                <td data-field="name">{{$userdata->phone}}</td>
                                <td data-field="name">{{$userdata->buisness_name}}</td>
                                <td data-field="name"><a href="" download="{{ asset($userdata->aadhar_image) }}"><img
                                            src="{{ asset($userdata->aadhar_image) }}" class="rounded-circle"
                                            width="50px" height="50px" alt="no record"></a></td>
                                <td data-field="name"><a href="" download="{{ asset($userdata->pancard_image) }}"><img
                                            class="rounded-circle" src="{{ asset($userdata->pancard_image) }}" alt=""
                                            width="50px" height="50px"></a>
                                </td>
                                <td data-field="name">
                                    <a href="" download="{{ asset($userdata->bank_statement) }}"><img
                                            src="{{ asset($userdata->bank_statement) }}" class="rounded-circle"
                                            width="50px" height="50px" alt=""></a>
                                </td>
                                <td data-field="name"><a href="" download="{{ asset($userdata->bank_passbook) }}"><img
                                            class="rounded-circle" src="{{ asset($userdata->bank_passbook) }}" alt=""
                                            width="50px" height="50px"></a>
                                </td>
                                <td data-field="name"><a href="" download="{{ asset($userdata->customer_image) }}"><img
                                            src="{{ asset($userdata->customer_image) }}" class="rounded-circle"
                                            width="50px" height="50px" alt=""></a></td>
                                <td data-field="name"><a href="" download="{{ asset($userdata->visit_pic) }}"><img
                                            class="rounded-circle" src="{{ asset($userdata->visit_pic) }}" alt=""
                                            width="50px" height="50px"></a></td>
                                <td data-field="name">{{$userdata->itr}}</td>
                                <td data-field="name">{{$userdata->gst}}</td>
                                <td data-field="name">{{$userdata->customers->loan_type}}</td>
                                <td data-field="name">{{$userdata->address}}</td>
                                @hasrole('admin|manager')<td data-field="name">
                                    <input type="checkbox" data-id="{{$userdata->id}}" class="toggle-class data click"
                                        id="data{{$loop->index}}" switch="none"
                                        {{$userdata->approved == '1'?'checked':''}} />
                                    <label for="data{{$loop->index}}" data-on-label="On" data-off-label="Off"></label>
                                </td>
                                @endhasrole
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">@can('customer_delete')
                                            <form action="{{ route('admin.customer.destroy',$userdata->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-sm edit fas fa-trash"
                                                    title="Delete">
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                        <div class="col-md-6">
                                            @can('customer_edit')
                                            <a href="{{route('admin.customer.edit',$userdata->id)}}"
                                                class="btn btn-outline-secondary btn-sm edit fas fa-pencil-alt"
                                                title="Edit">
                                            </a>
                                            @endcan
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
<!-- modal start  -->
<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Remark</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.approve')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="formrow-name-input" class="form-label">Enter Your Remark..</label>
                        <input type="text" class="form-control" id="formrow-name-input"
                            placeholder="Enter Your Remark.." name="remark">
                    </div>
                    <input id="id_of_remark" name="remark_id" type="hidden">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>

        </div>
    </div>
</div>
@endsection