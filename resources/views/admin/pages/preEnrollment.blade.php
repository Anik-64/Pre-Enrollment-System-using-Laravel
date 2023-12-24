@extends('admin.layout.adminDefault')

@section('content')

    @if($data->count() == 0)
        <div class="alert alert-info">There is no data in database</div>
    @else
        @php $count_total = 0 @endphp
        <div class="card mb-2">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5>Pre-enrollment Details</h5>
                <a href="{{ url('generate-excel') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
                    <i class="fas fa-file-export fa-sm text-white-50"></i>
                    Export Excel
                </a>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered table-sm table-responsive-md" id="pre_enrollment_table">
                    <thead class="table-active">
                        <tr>
                            <th>#</th>
                            <th>Total</th>
                            <th class="col-5">Students' ID</th>
                            <th class="text-center">Semester</th>
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
                                <td class="text-center">{{ $d->total }}</td>

                                @if($d->type == 'Recourse1st')

                                    @php 
                                        $student_info = \App\Models\enrollment::where('type', 'Recourse1st')->where('course_id', $d->course_id)->get('student_id');
                                    @endphp

                                    <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                                    <td class="text-center">1st</td>

                                @elseif($d->type == 'Recourse2nd')

                                    @php 
                                        $student_info = \App\Models\enrollment::where('type', 'Recourse2nd')->where('course_id', $d->course_id)->get('student_id');
                                    @endphp

                                    <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                                    <td class="text-center">2nd</td>

                                @elseif($d->type == 'Recourse3rd')

                                    @php 
                                        $student_info = \App\Models\enrollment::where('type', 'Recourse3rd')->where('course_id', $d->course_id)->get('student_id');
                                    @endphp

                                    <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                                    <td class="text-center">3rd</td>

                                @elseif($d->type == 'Recourse4th')

                                    @php 
                                        $student_info = \App\Models\enrollment::where('type', 'Recourse4th')->where('course_id', $d->course_id)->get('student_id');
                                    @endphp

                                    <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                                    <td class="text-center">4th</td>

                                @elseif($d->type == 'Recourse5th')

                                    @php 
                                        $student_info = \App\Models\enrollment::where('type', 'Recourse5th')->where('course_id', $d->course_id)->get('student_id');
                                    @endphp

                                    <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                                    <td class="text-center">5th</td>

                                @elseif($d->type == 'Recourse6th')

                                    @php 
                                        $student_info = \App\Models\enrollment::where('type', 'Recourse6th')->where('course_id', $d->course_id)->get('student_id');
                                    @endphp

                                    <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                                    <td class="text-center">6th</td>

                                @elseif($d->type == 'Recourse7th')

                                    @php 
                                        $student_info = \App\Models\enrollment::where('type', 'Recourse7th')->where('course_id', $d->course_id)->get('student_id');
                                    @endphp

                                    <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                                    <td class="text-center">7th</td>

                                @elseif($d->type == 'Recourse8th')

                                    @php 
                                        $student_info = \App\Models\enrollment::where('type', 'Recourse8th')->where('course_id', $d->course_id)->get('student_id');
                                    @endphp

                                    <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                                    <td class="text-center">8th</td>

                                @endif
                                <td>{{ $course_details->course_name.' ('.$course_details->semester.')' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-dark">
                @foreach($data as $d)
                    @php $count_total += $d->total @endphp
                @endforeach
                Total student {{ $count_total }}
            </div>
        </div>
    @endif
@endsection
