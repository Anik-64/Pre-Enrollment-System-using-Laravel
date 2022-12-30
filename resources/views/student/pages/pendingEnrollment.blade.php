@extends('student.layout.studentDefault')

@section('custom_css')
    <style>
        a .fa-trash-alt{
            color: #DC3545;
        }
    </style>
@endsection
@section('content')
    @if(Session::has('subject_name'))
    <div class="alert alert-success">{{ Session::get('subject_name') }}&nbsp<i class="fas fa-check"></i></div>
    @endif
    
    @if($enrollment_info->count() == 0)
        <div class="alert alert-info">You still don't enrollment</div>
    @else
        <a href="{{ url('remove-all-enrollment') }}" class="btn btn-danger btn-sm mb-2">Remove all</a>
        <table class="table table-hover table-responsive-md">
            <thead class="bg-gray-200">
                <th class="col-6">Course name</th>
                <th class="text-center">Course code</th>
                <th class="text-center">Semester</th>
                <th>status</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($enrollment_info as $e)
                @php
                $course_details = \App\Models\course::where('id', $e->course_id)->first();
                @endphp
                <tr>
                    <td>{{ $course_details->course_name }}</td>
                    <td class="text-center">{{ $course_details->course_code }}</td>
                    <td class="text-center">{{ $course_details->semester }}</td>
                    <td>
                        <span class="badge badge-success">Pending</span>
                    </td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#deleteEnrollment{{ $e->id }}">
                            <i class="far fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Delete subject"></i>
                        </a>
                        <!-- Delete modal -->
                        <div class="modal fade" id="deleteEnrollment{{ $e->id }}" tabindex="-1"   aria-labelledby="deleteEnrollmentLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteEnrollmentLabel">Delete Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to remove this subject <i class="text-warning">{{ $course_details->course_name }}</i> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                        <a href="{{ url('delete-enrollment/'.Crypt::encryptString($e->id)) }}"><button type="button" class="btn btn-success">Yes</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection