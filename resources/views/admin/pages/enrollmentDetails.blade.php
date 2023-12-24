@extends('admin.layout.adminDefault')

@section('topbar_search')
    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" id="searchData" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
        </div>
    </div>
@endsection

@section('content')
    @if($enrollment_details->count() == 0)
        <div class="alert alert-info">There are no data in <strong>Enrollment</strong> table</div>
    @else
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="text-center">Enrollment Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover table-sm table-striped table-bordered table-responsive-md" id="login_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Id</th>
                            <th>Course Name</th>
                            <th class="text-center">Course Code</th>
                            <th class="text-center">Credit Hour</th>
                            <th>Semester</th>
                            <th class="text-center">Current Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollment_details as $en)
                            @php
                                $course_data = \App\Models\course::where('id', $en->course_id)->first();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $en->student_id }}</td>
                                <td>{{ $course_data->course_name }}</td>
                                <td class="text-center">{{ $course_data->course_code }}</td>
                                <td class="text-center">{{ $course_data->credit_hour }}</td>
                                <td class="text-center">{{ $course_data->semester }}</td>
                                <td class="text-center">{{ $en->current_semester }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script>
        document.getElementById('searchData').addEventListener('keyup', function(){
            var input = document.getElementById('searchData');
            var filter = input.value.toUpperCase();
            var table = document.getElementById('login_table');
            var tr = table.getElementsByTagName('tr');
            for(let i=0; i<tr.length; i++){
                td = tr[i].getElementsByTagName('td')[0];
                td1 = tr[i].getElementsByTagName('td')[1];
                td2 = tr[i].getElementsByTagName('td')[2];
                if(td){
                    txtValue = td.textContent || td.innerText;
                    txtValue1 = td1.textContent || td1.innerText;
                    txtValue2 = td2.textContent || td2.innerText;
                    if(txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 ||
                        txtValue2.toUpperCase().indexOf(filter) > -1){
                        tr[i].style.display = "";
                    }else{
                        tr[i].style.display = "none";
                    }
                }
            }
        });
    </script>
@endsection