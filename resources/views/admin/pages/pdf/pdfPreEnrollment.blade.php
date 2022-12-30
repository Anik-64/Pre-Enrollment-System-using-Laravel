<style>
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
    }
</style>

    <table class="table table-hover table-responsive-md">
        <thead class="bg-gray-200">
            <tr>
                <th class="col-4">Total</th>
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
    
