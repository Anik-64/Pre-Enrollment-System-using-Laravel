@extends('admin.layout.adminDefault')

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-info">
            <strong>{{ Session::get('dept_name') }}</strong>
            {{ Session::get('success') }}&nbsp<i class="fas fa-check"></i>
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}&nbsp<i class="fas fa-times"></i></div>
    @endif

    @if($departments->count() == 0)
        <div class="alert alert-info">There are no data in <strong>Department</strong> table</div>
    @else
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Deparment Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover table-responsive-md">
                    <thead class="bg-gray-200">
                        <tr>
                            <th>#</th>
                            <th>Department name</th>
                            <th>Deparment abbreviation</th>
                            <th>Contact Number</th>
                            <th class="col-md-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $department->dept_name }}</td>
                                <td>{{ $department->dept_abbreviation }}</td>
                                <td>{{ $department->dept_contact_no }}</td>
                                <td class="text-center">
                                    <a href="#" class="mr-2" data-toggle="modal" data-target="#updateModal{{ $department->dept_id }}">
                                        <i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit Department Information"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#deleteModal{{ $department->dept_id }}">
                                        <i class="far fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Delete Department"></i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Update Modal -->
                            <div class="modal fade" id="updateModal{{ $department->dept_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update department</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('update-department/'.$department->dept_id) }}" method="post">
                                            @csrf
                                            <div class="modal-body">                                
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label for="">Department name</label>
                                                        <input type="text" name="dept_name" value="{{ $department->dept_name }}" id="dept_name" class="form-control">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="">Department abbreviation</label>
                                                        <select name="dept_abbreviation" id="dept_abbreviation" class="form-control">
                                                            <option value="CSE" {{ $department->dept_abbreviation == 'CSE' ? 'selected' : '' }}>CSE</option>
                                                            <option value="EEE" {{ $department->dept_abbreviation == 'EEE' ? 'selected' : '' }}>EEE</option>
                                                            <option value="ME" {{ $department->dept_abbreviation == 'ME' ? 'selected' : '' }}>ME</option>
                                                            <option value="LAW" {{ $department->dept_abbreviation == 'LAW' ? 'selected' : '' }}>LAW</option>
                                                            <option value="MATH" {{ $department->dept_abbreviation == 'MATH' ? 'selected' : '' }}>MATH</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row offset-3">
                                                    <div class="col-6">
                                                        <label for="">Deparment Contact Number</label>
                                                        <input type="text" name="dept_contact_no" value="{{ $department->dept_contact_no }}" id="dept_contact_no" class="form-control">                                                
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" id="sumbit_btn" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Modal -->
                            <div class="modal" id="deleteModal{{ $department->dept_id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <b>{{ $department->dept_name }}</b>?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ url('delete-department/'.$department->dept_id) }}"><button type="submit" class="btn btn-outline-success">Yes</button></a>
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">No</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
