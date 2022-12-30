<table>
    <thead>
        <tr>
            <th>Total Student</th>
            <th>Semester</th>
            <th>Course Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $preEnrollmentDetails as $preEnrollmentDetail )
            <tr>
                @php
                    $course_details = \App\Models\course::where('id', $preEnrollmentDetail->course_id)->first();
                @endphp
                <td>{{ $preEnrollmentDetail->total }}</td>
                @if( $preEnrollmentDetail->type == 'Recourse1semester' )
                    <td>1st</td>
                @elseif( $preEnrollmentDetail->type == 'Recourse2semester' )
                    <td>2nd</td>
                @elseif( $preEnrollmentDetail->type == 'Recourse3semester' )
                    <td>3rd</td>
                @elseif( $preEnrollmentDetail->type == 'Recourse4semester' )
                    <td>4th</td>
                @elseif( $preEnrollmentDetail->type == 'Recourse5semester' )
                    <td>5th</td>
                @elseif( $preEnrollmentDetail->type == 'Recourse6semester' )
                    <td>6th</td>
                @elseif( $preEnrollmentDetail->type == 'Recourse7semester' )
                    <td>7th</td>
                @elseif( $preEnrollmentDetail->type == 'Recourse8semester' )
                    <td>8th</td>
                @endif
                <td>{{ $course_details->course_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>