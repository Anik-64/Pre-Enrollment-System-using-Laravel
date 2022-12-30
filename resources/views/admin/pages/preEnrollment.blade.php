@extends('admin.layout.adminDefault')

@section('content')

    @if($data->count() == 0)
        <div class="alert alert-info">There is no data in database</div>
    @else
        <div class="card mb-2">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5>Pre-enrollment Details</h5>
                <a href="{{ url('generate-excel') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
                    <i class="fas fa-file-export fa-sm text-white-50"></i>
                    Export Excel
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered table-responsive-md" id="pre_enrollment_table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="col-1">#</th>
                            <th class="col-3">Total student</th>
                            <th class="col-3">Semester</th>
                            <th>Course name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                            <tr>
                                @php
                                    $course_details = \App\Models\course::where('id', $d->course_id)->first();
                                @endphp
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->total }}</td>
                                @if($d->type == 'Recourse1semester')
                                    <td>1st</td>
                                @elseif($d->type == 'Recourse2semester')
                                    <td>2nd</td>
                                @elseif($d->type == 'Recourse3semester')
                                    <td>3rd</td>
                                @elseif($d->type == 'Recourse4semester')
                                    <td>4th</td>
                                @elseif($d->type == 'Recourse5semester')
                                    <td>5th</td>
                                @elseif($d->type == 'Recourse6semester')
                                    <td>6th</td>
                                @elseif($d->type == 'Recourse7semester')
                                    <td>7th</td>
                                @elseif($d->type == 'Recourse8semester')
                                    <td>8th</td>
                                @endif
                                <td>{{ $course_details->course_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
