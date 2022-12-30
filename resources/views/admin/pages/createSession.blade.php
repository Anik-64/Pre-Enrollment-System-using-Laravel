@extends('admin.layout.adminDefault')

@section('content')

    <form action="{{ url('store-session') }}" method="post">
        @csrf
        <div class="row offset-md-1">
            <div class="col-md-3">
                <select name="session_name" id="session_name" class="form-control mb-3">
                    <option value="" class="bg-gray-200">Select session</option>
                    <option value="Spring" class="bg-gray-200" {{ Session::get('session_name') == 'Spring' ? 'selected' : '' }}>Spring</option>
                    <option value="Fall" class="bg-gray-200" {{ Session::get('session_name') == 'Fall' ? 'selected' : '' }}>Fall</option>
                </select>                
            </div>
            <div class="col-md-3">
                <select name="session_year" id="session_year" class="form-control mb-3">
                    <option value="" class="bg-gray-200">Select year</option>
                    @php
                        $length = 2040;
                    @endphp
                    @for($i=2020; $i<$length; $i++)
                        <option value="{{ $i }}" class="bg-gray-200" {{ Session::get('session_year') == strval($i) ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <select name="session_status" id="session_status" class="form-control mb-3">
                    <option value="">Select status</option>
                    <option value="Active" class="bg-gray-200" {{ Session::get('session_status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" class="bg-gray-200" {{ Session::get('session_status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-info btn-md submit_btn">
                    <i class="fas fa-arrow-circle-down"></i>
                    Create Session
                </button>
            </div>
        </div>
    </form>

    <hr>

    <!-- Table content -->
    @if( $session_info->count() == 0 )
        <div class="alert alert-info">There are no data in session table</div>
    @else
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="text-center">Session Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover table-responsive-md">
                    <thead class="bg-gray-200">
                        <tr>
                            <th>#</th>
                            <th>Session name</th>
                            <th>Session status</th>
                            <th class="col-md-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($session_info as $s)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $s->name }}( B.Sc. )</td>
                                <td>
                                    @if($s->status == 'Active')
                                        <span class="badge badge-success">{{ $s->status }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ $s->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($s->status == 'Active')
                                        <a href="{{ url('change-status/'.$s->session_id) }}" class="mr-2">
                                            <button class="btn btn-warning btn-sm">Inactive</button>
                                        </a>
                                    @else
                                        <a href="{{ url('change-status/'.$s->session_id) }}" class="mr-3">
                                            <button class="btn btn-success btn-sm">Active</button>
                                        </a>
                                    @endif
                                    <a href="{{ url('delete-session/'.Crypt::encryptString($s->session_id)) }}">
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <!-- End table content -->

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.submit_btn').prop('disabled', true);
            $('#session_name, #session_status, #session_year').change(function(){
                if( $('#session_name').val() != '' && $('#session_status').val() != '' && $('#session_year').val() != ''  ){
                    $('.submit_btn').prop('disabled', false);
                }else{
                    $('.submit_btn').prop('disabled', true);
                }
            });
        })
    </script>
@endsection