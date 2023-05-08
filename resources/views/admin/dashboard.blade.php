@extends('admin.includes.master',['breadcrumb_title' => 'Dashboard'])
@section('title', 'Dashboard')
@section('style-area')

@endsection
@section('content-area')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Attendance</h4>

                <form action="{{ route('admin.attendance') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6" hidden>
                            <div class="mb-3">
                                <input type="date" name="date" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-md"
                                    {{ isset($attendance) ? ($attendance->clock_in != null ? 'disabled' : '') : '' }}>Clock
                                    In</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-md"
                                    {{ isset($attendance) ? ($attendance->clock_out != null ? 'disabled' : '') : 'disabled' }}>Clock
                                    Out</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-editable table-nowrap align-middle table-edits">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Date</th>
                                <th>Entry-Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($get_data as $data)
                            <tr>
                                <td>{{$loop->index+1??''}}</td>
                                <td>{{$data->date??''}}</td>
                                <td data-field="name">{{$data->clock_in??''}}</td>
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
@section('script-area')

@endsection