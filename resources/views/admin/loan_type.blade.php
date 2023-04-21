@extends('includes.master')

@section('content-area')
<form action="" method="post"
    enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-10">
            <div class="mb-3">
                <label for="formrow-role-input" class="form-label">Loan Type</label>
                <input type="text" class="form-control" id="formrow-role-input" placeholder="Enter Your Loan Type"
                    name="role" value="">
            </div>
        </div>
        <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-md">Submit</button>
        </div>
    </div>
</form>
@endsection