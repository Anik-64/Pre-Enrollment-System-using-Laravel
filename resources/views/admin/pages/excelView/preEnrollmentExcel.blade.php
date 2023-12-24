    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Total</th>
                <th>Semester</th>
                <th>Students' ID</th>
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

                    @if($d->type == 'Recourse1st')

                        @php 
                            $student_info = \App\Models\enrollment::where('type', 'Recourse1st')->where('course_id', $d->course_id)->get('student_id');
                        @endphp

                        <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                        <td>1st</td>

                    @elseif($d->type == 'Recourse2nd')

                        @php 
                            $student_info = \App\Models\enrollment::where('type', 'Recourse2nd')->where('course_id', $d->course_id)->get('student_id');
                        @endphp

                        <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                        <td>2nd</td>

                    @elseif($d->type == 'Recourse3rd')

                        @php 
                            $student_info = \App\Models\enrollment::where('type', 'Recourse3rd')->where('course_id', $d->course_id)->get('student_id');
                        @endphp

                        <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                        <td>3rd</td>

                    @elseif($d->type == 'Recourse4th')

                        @php 
                            $student_info = \App\Models\enrollment::where('type', 'Recourse4th')->where('course_id', $d->course_id)->get('student_id');
                        @endphp

                        <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                        <td>4th</td>

                    @elseif($d->type == 'Recourse5th')

                        @php 
                            $student_info = \App\Models\enrollment::where('type', 'Recourse5th')->where('course_id', $d->course_id)->get('student_id');
                        @endphp

                        <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                        <td>5th</td>

                    @elseif($d->type == 'Recourse6th')

                         @php 
                            $student_info = \App\Models\enrollment::where('type', 'Recourse6th')->where('course_id', $d->course_id)->get('student_id');
                        @endphp

                        <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                        <td>6th</td>

                    @elseif($d->type == 'Recourse7th')

                        @php 
                            $student_info = \App\Models\enrollment::where('type', 'Recourse7th')->where('course_id', $d->course_id)->get('student_id');
                        @endphp

                        <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                        <td>7th</td>

                     @elseif($d->type == 'Recourse8th')

                        @php 
                            $student_info = \App\Models\enrollment::where('type', 'Recourse8th')->where('course_id', $d->course_id)->get('student_id');
                        @endphp

                        <td>@foreach($student_info as $student_info) {{ $student_info->student_id }} @if(!$loop->last) , @endif @endforeach</td>
                        <td>8th</td>

                    @endif
                    <td>{{ $course_details->course_name.'('.$course_details->semester.')' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>    