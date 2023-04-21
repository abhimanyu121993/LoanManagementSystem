@extends('admin.includes.master', ['breadcrumb_title' => 'Has Permission'])
@section('title','Has Permission')
@section('style-area')

@endsection
@section('content-area')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Has Permission Form </h4>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Role Select</label>
                            <select class="form-control select2 roles" name="roles">
                                <!-- <option selected disabled hidden>--Select Role--</option> -->
                                <optgroup label="Roles">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name ?? ''}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary w-md fatchBtn">Fetch</button>
                </div>

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
        <div class="card permissionClass">
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection
@section('script-area')
<script>
    $(document).ready(function() {
        $(document).on('click', '.fatchBtn', function() {
            var form_data = $('.roles').val();
            var newurl = "{{route('admin.rolePermissionFatch')}}";
            $.ajax({
                method: 'get',
                url: newurl,
                data: {
                    'roles': form_data,
                },
                success: function(p) {
                    $('.permissionClass').html(p);
                },
                error: function(a) {
                    if (a.status == 422) {
                        var data = $.parseJSON(a.responseText);
                        $.each(data.errors, function(key, val) {
                            alert(val);
                        });
                    }
                }
            });
        });
    });
</script>
@endsection