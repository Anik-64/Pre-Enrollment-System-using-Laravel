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
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="text-center">Login Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped table-bordered table-responsive-md" id="login_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Login time</th>
                        <th>Duration</th>
                        <th>Logout time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($login_data as $log)
                    <tr>
                        <td>{{ $log->name }}</td>
                        <td>{{ $log->email }}</td>
                        <td>{{ \Carbon\Carbon::parse( $log->login_time )->toDayDateTimeString() }}</td>
                        <td>{{ $log->duration }}</td>
                        <td>{{ \Carbon\Carbon::parse( $log->logout_time )->toDayDateTimeString() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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