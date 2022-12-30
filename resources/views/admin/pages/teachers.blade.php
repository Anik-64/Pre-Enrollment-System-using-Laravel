@extends('admin.layout.adminDefault')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-info"><strong>{{ Session::get('t_name') }}</strong>{{ Session::get('success') }}&nbsp<i class="fas fa-check"></i></div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}&nbsp<i class="fas fa-times"></i></div>
    @endif

    @if(Session::has('delete_success'))
        <div class="alert alert-info"><strong>{{ Session::get('t_name') }}</strong>{{ Session::get('delete_success') }}&nbsp<i class="fas fa-check"></i></div>
    @endif

    @if($teachers->count() == 0)
        <div class="alert alert-info">There are no data in <strong>Teachers</strong> table</div>
    @else
        <div class="card">
            <div class="card-header text-center">
                <h5>Teacher's Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover table-responsive-md">
                    <thead class="bg-gray-200">
                        <tr>
                            <th>#</th>
                            <th>Teacher name</th>
                            <th>Teacher email</th>
                            <th>Teacher designation</th>
                            <th>Department</th>
                            <th class="col-md-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->t_name }}</td>
                                <td>{{ $t->t_email }}</td>
                                <td>{{ $t->t_designation }}</td>
                                @php
                                    $department_abbreviation = App\Models\department::where('dept_id', $t->dept_id)->first();
                                @endphp
                                <td>{{ $department_abbreviation->dept_abbreviation }}</td>
                                <td class="text-center">
                                    <a href="#" class="mr-2" data-toggle="modal" data-target="#updateModal{{ $t->t_id }}">
                                        <i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit teacher information"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#deleteModal{{ $t->t_id }}">
                                        <i class="far fa-trash-alt" data-toggle="tooltip" data-placement="top" title="delete teacher"></i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Update Modal -->
                            <div class="modal fade" id="updateModal{{ $t->t_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Teacher</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('update-teacher/'.$t->t_id) }}" method="post">
                                            @csrf
                                            <div class="modal-body">                                
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label for="">Teacher name</label>
                                                        <input type="text" name="t_name" value="{{ $t->t_name }}" id="" class="form-control">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="">Teacher email</label>
                                                        <input type="email" name="t_email" value="{{ $t->t_email }}" id="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="">Teacher designation</label>
                                                        <select name="t_designation" id="" class="form-control">
                                                            <option value="Lecturer" {{ $t->t_designation == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                                                            <option value="Assistant lecturer" {{ $t->t_designation == 'Assistant lecturer' ? 'selected' : '' }}>Assistant lecturer</option>
                                                            <option value="Professor" {{ $t->t_designation == 'Professor' ? 'selected' : '' }}>Professor</option>
                                                            <option value="Assistant Professor" {{ $t->t_designation == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                                                            <option value="Associate Professor" {{ $t->t_designation == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="">Department</label>
                                                        <select name="department" id="" class="form-control">
                                                            @foreach($departments as $d)
                                                            <option value="{{ $d->dept_id }}" {{ $d->dept_id == $t->dept_id ? 'selected' : '' }} >{{ $d->dept_abbreviation }}</option>
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
                            <div class="modal" id="deleteModal{{ $t->t_id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <b>{{ $t->t_name }}</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ url('delete-teacher/'.$t->t_id) }}"><button type="submit" class="btn btn-outline-success">Yes</button></a>
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">No</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex align-items-center justify-content-center">
                    {{ $teachers->links() }}
                </div>
            </div>
        </div>
    @endif
@endsection