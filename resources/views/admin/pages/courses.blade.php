@extends('admin.layout.adminDefault')

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-info">
            <strong>{{ Session::get('course_name') }}</strong>
            {{ Session::get('success') }}&nbsp<i class="fas fa-check"></i>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}&nbsp<i class="fas fa-times"></i></div>
    @endif

    @if(Session::has('delete_success'))
        <div class="alert alert-info">
            <strong>{{ Session::get('course_name') }}</strong>
            {{ Session::get('delete_success') }}&nbsp<i class="fas fa-check"></i>
        </div>
    @endif

    @if($courses->count() == 0)
        <div class="alert alert-info">There are no data in <strong>Course</strong> table</div>
    @else
        <div class="card mb-2">
            <div class="card-header text-center">
                <h5>Course Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover table-responsive-md">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="col-5">Course name</th>
                            <th>Course code</th>
                            <th>Credit hour</th>
                            <th>Department</th>
                            <th>Semester</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->course_name }}</td>
                                <td>{{ $course->course_code }}</td>
                                <td>{{ $course->credit_hour }}</td>
                                @php 
                                    $abbreviation = App\Models\department::where('dept_id', $course->dept_id)->first();
                                @endphp
                                <td>{{ $abbreviation->dept_abbreviation }}</td>
                                <td>{{ $course->semester }}</td>
                                <td class="text-center">
                                    <a href="" class="mr-1" data-toggle="modal" data-target="#updateModal{{ $course->id }}">
                                        <i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit course information"></i>
                                    </a>
                                    <a href="" data-toggle="modal" data-target="#deleteModal{{ $course->id }}">
                                        <i class="far fa-trash-alt" data-toggle="tooltip" data-placement="top" title="delete course"></i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Update Modal -->
                            <div class="modal fade" id="updateModal{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Course</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('update-course/'.$course->id) }}" method="post">
                                            @csrf
                                            <div class="modal-body">                                
                                                <div class="row mb-2">
                                                    <div class="col-8">
                                                        <label for="">Course name</label>
                                                        <input type="text" name="course_name" value="{{ $course->course_name }}" id="" class="form-control">
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="">Course code</label>
                                                        <input type="text" name="course_code" value="{{ $course->course_code }}" id="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label for="">Credit hour</label>
                                                        <select name="credit_hour" id="" class="form-control">
                                                            <option value="1" {{ $course->credit_hour == '1' ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $course->credit_hour == '2' ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $course->credit_hour == '3' ? 'selected' : '' }}>3</option>
                                                            <option value="3.5" {{ $course->credit_hour == '3.5' ? 'selected' : '' }}>3.5</option>
                                                            <option value="4" {{ $course->credit_hour == '4' ? 'selected' : '' }}>4</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="">Semester</label>
                                                        <select name="semester" id="" class="form-control">
                                                            <option value="1st" {{ $course->semester == '1st' ? 'selected' : '' }}>1st</option>
                                                            <option value="2nd" {{ $course->semester == '2nd' ? 'selected' : '' }}>2nd</option>
                                                            <option value="3rd" {{ $course->semester == '3rd' ? 'selected' : '' }}>3rd</option>
                                                            <option value="4th" {{ $course->semester == '4th' ? 'selected' : '' }}>4th</option>
                                                            <option value="5th" {{ $course->semester == '5th' ? 'selected' : '' }}>5th</option>
                                                            <option value="6th" {{ $course->semester == '6th' ? 'selected' : '' }}>6th</option>
                                                            <option value="7th" {{ $course->semester == '7th' ? 'selected' : '' }}>7th</option>
                                                            <option value="8th" {{ $course->semester == '8th' ? 'selected' : '' }}>8th</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="">Department</label>
                                                        <select name="department" id="" class="form-control">
                                                            @foreach($departments as $d)
                                                            <option value="{{ $d->dept_id }}" {{ $d->dept_id == $course->dept_id ? 'selected' : '' }} >{{ $d->dept_abbreviation }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Modal -->
                            <div class="modal" id="deleteModal{{ $course->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <b>{{ $course->course_name }}</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ url('delete-course/'.$course->id) }}"><button type="submit" class="btn btn-outline-success">Yes</button></a>
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">No</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-end">
                {{ $courses->links() }}
            </div>
        </div>
    @endif

@endsection

