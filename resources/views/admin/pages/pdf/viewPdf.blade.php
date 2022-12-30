<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-enrollment Details</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #ccc;
            text-align: left;
            padding: 8px;
        }

        th {
            background: #3498db;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

    <div style="display: flex; align-items: center; justify-content: center">
        <h2>Pre-enrollment Details</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Total</th>
                <th>Semester</th>
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
</body>
</html>