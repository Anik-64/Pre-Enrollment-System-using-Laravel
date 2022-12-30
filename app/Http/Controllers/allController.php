<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Arr;
use App\Exports\PreEnrollmentExport;
use App\Models\registration;
use App\Models\department;
use App\Models\teacher;
use App\Models\course;
use App\Models\SessionInfo;
use App\Models\enrollment;
use Image;
use File;
use DB;
use Session;
use PDF;
use Carbon\Carbon;
use QrCode;
use Excel;
use Alert;
use Str;

class allController extends Controller
{
    public function registration(){
        return view('authentication.register');
    }

    public function storeRegister(Request $rqt){
        $name = $rqt->name;
        $email = $rqt->email;
        $student_id = $rqt->student_id;
        $password = $rqt->password;
        $confirm_pass = $rqt->confirm;
        $encrypt_password = Hash::make($password);

        if($password != $confirm_pass){
            if(strlen($student_id) == 13){
                return redirect()->back()
                    ->with(['error' => '*Password is missmatch', 'student_id' => $student_id, 'name' => $name, 'email' => $email]);
            }
            return redirect()->back()->with(['error' => '*Password is missmatch', 'name' => $name, 'email' => $email]);
        }
        if(strlen($student_id) != 13){
            return redirect()->back()->with(['id_error' => '*ID must be 13 digit', 'name' => $name, 'email' => $email]);
        }

        $fetch = registration::where('student_id', $student_id)->where('email', $email)->first();
        
        if($fetch){
            return redirect()->back()
            ->with('fetch_error', 'You have already registered! Please Login.');
        }
        else{

            $fetch_student_id = registration::where('student_id', $student_id)->first();
        
            if($fetch_student_id){
                return redirect()->back()->with(['id_error' => '*This ID already exist', 'student_id' => $student_id, 'name' => $name, 'email' => $email]);
            }else{
                registration::insert([
                    'student_id' => $student_id,
                    'name' => $name,
                    'email' => $email,
                    'password' => $encrypt_password
                ]);
                return redirect('login');
            }
        }
    }

    public function login(){
        return view('authentication.login');
    }

    public function storeLogin(Request $rqt){
        $email = $rqt->email;
        $password = $rqt->password;

        if($email == '' && $password == ''){
            return redirect()->back()
            ->with(['blank_user_field' => '*Email is required', 'blank_password_field' => '*Password is required']);
        }
        if($email == ''){
            return redirect()->back()->with(['blank_user_field' => '*Email is required', 'password' => $password]);
        }
        if($password == ''){
            return redirect()->back()->with(['blank_password_field' => '*Password is required', 'email' => $email]);
        }

        $fetch_teacher = teacher::where('t_email', $email)->first();

        if($fetch_teacher){
            if($fetch_teacher->role == 'admin'){
                $time = Carbon::now()->timezone('Asia/Dhaka')->format('Y-m-d H:i:s');
                DB::table('login_details')->insert([
                    'name' => $fetch_teacher->t_name,
                    'email' => $email,
                    'login_time' => $time
                ]);
                    
                Session::put([
                    'name' => $fetch_teacher->t_name, 
                    'userrole' => $fetch_teacher->role,
                    'login_time' => $time
                ]);

                return redirect('admin-dashboard');
            }
        }
        else{
            $fetch_student = registration::where('email', $email)->first();
            if(!$fetch_student){  
                return redirect()->back()->with('registration_error', 'You are not registerd. Please register first.');
            }                      
            if($email == $fetch_student->email && !Hash::check($password,$fetch_student->password)){
                return redirect()->back()
                ->with(['password_error' => '*Wrong password', 'email' => $fetch_student->email]);
            }
            if($email == $fetch_student->email && Hash::check($password,$fetch_student->password)){
    
                $time = Carbon::now()->timezone('Asia/Dhaka')->format('Y-m-d H:i:s');
                
                DB::table('login_details')->insert([
                    'name' => $fetch_student->name,
                    'email' => $email,
                    'login_time' => $time
                ]);
                
                Session::put([
                    'name' => $fetch_student->name, 
                    'userrole' => $fetch_student->role,
                    'login_time' => $time,
                    'student_id' => $fetch_student->student_id,
                    'student_email' => $email
                ]);

                return redirect('student-dashboard');
            }
        }      
    }

    public function logout(){
        $get_time = Session::get('login_time');
        $diff = Carbon::now()->diffInMinutes($get_time);
        if($diff >= 60){
            $min = $diff % 60;
            $hour = intval($diff / 60);
            DB::table('login_details')->where('login_time', $get_time)
                ->update([
                    'duration' => $hour.'h '.$min.'m',
                    'logout_time' => Carbon::now()
                ]);
        }
        if($diff < 60){
            $sec_diff = Carbon::now()->diffInSeconds($get_time);
            $min = floor($sec_diff / 60);
            $sec = $sec_diff % 60;
            DB::table('login_details')->where('login_time', $get_time)
            ->update([
                'duration' => $min.'m '.$sec.'s',
                'logout_time' => Carbon::now()
            ]);
        }

        if(Session::has('student_id') && Session::has('student_email')){
            Session::flush(['name', 'userrole', 'login_time', 'student_id', 'student_email']);
        }
        Session::flush(['name', 'userrole', 'login_time']);
        return redirect('login');
    }

    public function loginDetails(){
        $login_data = DB::table('login_details')->orderBy('id', 'desc')->get();
        return view('admin.pages.loginDetails', compact('login_data'));
    }

    public function adminDashboard(){
        return view('admin.pages.adminDashboard', 
            ['student_data' => registration::count(), 
            'course_data' => course::count(),
            'department_data' => department::count(),
            'teacher_data' => teacher::count(),
            'enrollment_data' => enrollment::count()
            ]);
    }

    public function changeAdminPassword(Request $rqt){
        $password = $rqt->password;
        $confirm_password = $rqt->confirm_password;
        
        if($password == '' && $confirm_password == ''){
            return redirect()->back()->with('error', 'Password fields are missing');
        }
        if($password != $confirm_password){
            return redirect()->back()->with('error', 'Passwords are missmatch');
        }
        
        teacher::where('role', 'admin')
            ->update([
                't_password' => Hash::make($password)
            ]);
        
        toast('Password is updated successfully','success')->autoClose(4000);

        return redirect()->back();
    }

    // Create Session
    public function createSession(){
        $session_info = SessionInfo::get();
        return view('admin.pages.createSession', compact('session_info'));
    }

    public function storeSession(Request $rqt){
        $session_name = $rqt->session_name;
        $session_year = $rqt->session_year;
        $session_status = $rqt->session_status;

        if($session_name == '' && $session_year == '' && $session_status == ''){
            return redirect()->back()->with('error', 'Required fields are missing');
        }
        if($session_name == ''){
            return redirect()->back()->with([
                'error' => 'Session name is missing',
                'session_year' => $session_year,
                'session_status' => $session_status
            ]);
        }
        if($session_year == ''){
            return redirect()->back()->with([
                'error' => 'Session year is missing',
                'session_name' => $session_name,
                'session_status' => $session_status
            ]);
        }
        if($session_status == ''){
            return redirect()->back()->with([
                'error' => 'Session status is missing',
                'session_name' => $session_name,
                'session_year' => $session_year
            ]);
        }
        
        SessionInfo::insert([
            'name' => $session_name.' '.$session_year,
            'status' => $session_status
        ]);

        alert()->success('Session Confirmation!', 'Session added successfully')->autoClose(2000);

        return redirect()->back();
    }

    public function changeStatus($id){
        $get_status = SessionInfo::where('session_id', $id)->first();

        if($get_status->status == 'Active'){
            SessionInfo::where('session_id', $id)->update(['status' => 'Inactive']);
            toast('Session status deactivated successfully','info')->autoClose(4000);
            return redirect()->back();
        }
        if($get_status->status == 'Inactive'){
            SessionInfo::where('session_id', $id)->update(['status' => 'Active']);
            toast('Session status activated successfully','info')->autoClose(4000);
            return redirect()->back();
        }
        
    }

    public function deleteSession($id){
        $decrypt_id = Crypt::decryptString($id);
        SessionInfo::where('session_id', $decrypt_id)->delete();

        toast('Session deleted successfully','success')->autoClose(4000);

        return redirect()->back();
    }
    // End of create Session

    // Create Course Course section
    public function createCourse(){
        $departments = department::orderBy('dept_abbreviation', 'asc')->get();
        return view('admin.pages.createCourse', compact('departments'));
    }

    public function storeCourse(Request $rqt){
        $course_name = $rqt->course_name;
        $course_code = $rqt->course_code;
        $credit_hour = $rqt->credit_hour;
        $semester = $rqt->semester;
        $department = $rqt->department;
        $array_of_department = [];

        if($department == ''){
            return redirect()->back()->with('department_error', 'Please select DEPARTMENT');
        }

        $department_id = department::where('dept_abbreviation', $department)->first();

        for($i=0; $i<count($course_name); $i++){
            array_push($array_of_department, $department_id->dept_id);
            if($course_name[$i] == '' && $course_code[$i] == '' && $credit_hour[$i] == '' && $semester[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data below');
            }
            if($course_name[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data in course field');
            }
            if($course_code[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data in course code field');
            }
            if($credit_hour[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data in credit hour field');
            }
            if($semester[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data in semester field');
            }

            // Check Duplicate data 
            $fetch = course::where('course_name', $course_name[$i])->first();  

            if($fetch){
                return redirect()->back()->with(['duplicate_error' => ' course already exist. Check course please.', 'course_name' => $course_name[$i]]);
            }
            else{
                course::insert([
                    'course_name' => $course_name[$i],
                    'course_code' => $course_code[$i],
                    'credit_hour' => $credit_hour[$i],
                    'semester' => $semester[$i],
                    'dept_id' => $array_of_department[$i]
                ]);
            }
        }

        alert()->success('Course Confirmation!', 'New course inserted successfully')->autoClose(3000);

        return redirect('courses');
    }

    public function courses(){
        $courses = DB::table('courses')->paginate(8);
        $departments = department::get();
        return view('admin.pages.courses', compact('courses', 'departments'));
    }

    public function updateCourse(Request $rqt, $id){
        $course_name = $rqt->course_name;
        $course_code = $rqt->course_code;
        $credit_hour = $rqt->credit_hour;
        $semester = $rqt->semester;
        $department_id = $rqt->department;

        if($course_name == '' && $course_code == '' && $credit_hour == '' && $semester == '' && $department == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing fields');
        }
        if($course_name == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Course name');
        }
        if($course_code == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Course code');
        }
        if($credit_hour == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Credit hour');
        }
        if($semester == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Semester');
        }
        if($department == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Department');
        }

        // $department_id = department::where('dept_abbreviation', $department)->first();

        course::where('id', $id)
            ->update([
                'course_name' => $course_name, 
                'course_code' => $course_code, 
                'credit_hour' => $credit_hour,
                'semester' => $semester,
                'dept_id' => $department_id
            ]);

        toast($course_name.' updated successfully','success')->autoClose(4000);
            
        return redirect()->back(); 
    }

    public function deleteCourse($id){
        $data = course::where('id', $id)->first();
        course::where('id', $id)->delete();

        toast($data->course_name.' deleted successfully','success')->autoClose(4000);

        return redirect()->back(); 
    }

    // public function duplicateCourse(Request $rqt){
    //     $course_name = $rqt->courseName;
    //     $check = course::where('course_name', $course_name)->first();
    //     if($check){
    //         return response()->json([
    //             'duplicate' => $check
    //         ]);
    //     }else{
    //         return response()->json([
    //             'duplicate' => 'Not found'
    //         ]);
    //     }
    // }
    // End of Create Course section

    // Create Department Section
    public function createDepartment(){
        return view('admin.pages.createDepartment');
    }

    public function storeDepartment(Request $rqt){
        $dept_name = $rqt->dept_name;
        $dept_abbreviation = $rqt->dept_abbreviation;
        $dept_contact_no = $rqt->dept_contact_no;

        for($i=0; $i<count($dept_name); $i++){
            if($dept_name[$i] == '' && $dept_abbreviation[$i] == '' && $dept_contact_no[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data below');
            }
            if($dept_name[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data in Deparment field');
            }
            if($dept_abbreviation[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data in Abbreviation field');
            }
            if($dept_contact_no[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data in Contact Number field');
            }

            // Check Duplicate data 
            $fetch = department::where('dept_name', $dept_name[$i])->first();  

            if($fetch){
                return redirect()->back()->with(['duplicate_error' => ' department already exist. Check department please.', 'dept_name' => $dept_name[$i]]);
            }
            else{
                department::insert([
                    'dept_name' => $dept_name[$i],
                    'dept_abbreviation' => $dept_abbreviation[$i],
                    'dept_contact_no' => $dept_contact_no[$i]
                ]);
            }
        }
        
        alert()->success('Department Confirmation!', 'New departmen inserted successfully')->autoClose(3000);
        
        return redirect('departments');
    }

    public function departments(){
        $departments = department::get();
        return view('admin.pages.departments', compact('departments'));
    }

    public function updateDepartment(Request $rqt, $id){
        $dept_name = $rqt->dept_name;
        $dept_abbreviation = $rqt->dept_abbreviation;
        $dept_contact_no = $rqt->dept_contact_no;

        if($dept_name == '' && $dept_contact_no == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing fields');
        }
        if($dept_name == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Department name');
        }
        if($dept_abbreviation == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Deparment abbreviation');
        }
        if($dept_contact_no == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Department Contact Number');
        }

        department::where('dept_id', $id)
            ->update([
                'dept_name' => $dept_name, 
                'dept_abbreviation' => $dept_abbreviation, 
                'dept_contact_no' => $dept_contact_no
            ]);
        
        toast($dept_name.' updated successfully','success')->autoClose(4000);
        
        return redirect()->back(); 
    }

    public function deleteDepartment($id){
        $data = department::where('dept_id', $id)->first();
        department::where('dept_id', $id)->delete();

        toast($data->dept_name.' deleted successfully','success')->autoClose(4000);

        return redirect()->back(); 
    }
    // End of Create Department section

    // Create Teacher Section
    public function createTeacher(){
        $departments = department::orderBy('dept_abbreviation', 'asc')->get();
        return view('admin.pages.createTeacher', compact('departments'));
    }

    public function storeTeacher(Request $rqt){
        $tech_name = $rqt->t_name;
        $tech_email = $rqt->t_email;
        $tech_designation = $rqt->t_designation;
        $department = $rqt->department;
        $array_of_department = [];

        if($department == ''){
            return redirect()->back()->with('department_error', 'Please! select DEPARTMENT');
        }

        $department_id = department::where('dept_abbreviation', $department)->first();

        for($i=0; $i<count($tech_name); $i++){
            array_push($array_of_department, $department_id->dept_id);
            if($tech_name[$i] == '' && $tech_email[$i] == '' && $tech_designation[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data below');
            }
            if($tech_name[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data in Teacher name field');
            }
            if($tech_email[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data in Teacher email field');
            }
            if($tech_designation[$i] == ''){
                return redirect()->back()->with('error', 'Please! Enter some data in Teacher designation field');
            }

            // Check Duplicate data 
            $fetch = teacher::where('t_name', $tech_name[$i])->first();  

            if($fetch){
                return redirect()->back()->with(['duplicate_error' => ' already exists. Check teacher please.', 't_name' => $tech_name[$i]]);
            }
            else{
                teacher::insert([
                    't_name' => $tech_name[$i],
                    't_email' => $tech_email[$i],
                    't_designation' => $tech_designation[$i],
                    'dept_id' => $array_of_department[$i]
                ]);
            }
        }

        alert()->success('Teacher Confirmation!', 'New teacher inserted successfully')->autoClose(3000);

        return redirect('teachers');

    }

    public function teachers(){
        $teachers = teacher::paginate(9);
        $departments = department::get();
        return view('admin.pages.teachers', compact('teachers', 'departments'));
    }

    public function updateTeacher(Request $rqt, $id){
        $tech_name = $rqt->t_name;
        $tech_email = $rqt->t_email;
        $tech_designation = $rqt->t_designation;
        $department_id = $rqt->department;

        if($tech_name == '' && $tech_email == '' && $tech_designation == '' && $department == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing fields');
        }
        if($tech_name == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Teacher name');
        }
        if($tech_email == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Teacher email');
        }
        if($tech_designation == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Teacher designation');
        }
        if($department_id == ''){
            return redirect()->back()->with('error', 'Data is not updated due to missing field Department');
        }

        teacher::where('t_id', $id)
            ->update([
                't_name' => $tech_name, 
                't_email' => $tech_email, 
                't_designation' => $tech_designation,
                'dept_id' => $department_id
            ]);

        toast($tech_name.' updated successfully','success')->autoClose(4000);
        
        return redirect()->back(); 
    }

    public function deleteTeacher($id){
        $data = DB::table('teachers')->where('t_id', $id)->first();
        DB::table('teachers')->where('t_id', $id)->delete();

        toast($data->t_name.' deleted successfully','success')->autoClose(4000);

        return redirect()->back(); 
    }
    // End of create Teacher Section

    // Student information
    public function studentDashboard(){
        $data = registration::where('student_id', Session::get('student_id'))->first();

        $i = 3;
        if( !is_null($data->phone) ){
            $i++;
        }
        if( !is_null($data->address) ){
            $i++;
        }
        if( !is_null($data->father_name) ){
            $i++;
        }
        if( !is_null($data->mother_name) ){
            $i++;
        }
        if( !is_null($data->blood_group) ){
            $i++;
        }
        if( !is_null($data->gender) ){
            $i++;
        }
        if( !is_null($data->image) ){
            $i++;
        }
        $account_setup = $i;

        return view('student.pages.studentDashboard', compact('data', 'account_setup'));
    }

    public function updatePersonalData(Request $rqt){

        $phone       = $rqt->phone;
        $address     = $rqt->address;
        $father_name = $rqt->father_name;
        $mother_name = $rqt->mother_name;
        $blood_group = $rqt->blood_group;
        $gender      = $rqt->gender;

        if( $rqt->image ){
            $image = $rqt->file('image');
            $img = rand().'.'.$image->getClientOriginalExtension();
            $location = public_path('thumbnail/'.$img);
            Image::make($image)->save($location);
            $image = $img;

            registration::where('student_id', Session::get('student_id'))->update([
                'phone' => $phone,
                'address' => $address,
                'father_name' => $father_name,
                'mother_name' => $mother_name,
                'blood_group' => $blood_group,
                'gender' => $gender,
                'image' => $image
            ]);
            return redirect()->back();
        }
        else{
            registration::where('student_id', Session::get('student_id'))->update([
                'phone' => $phone,
                'address' => $address,
                'father_name' => $father_name,
                'mother_name' => $mother_name,
                'blood_group' => $blood_group,
                'gender' => $gender
            ]);
            return redirect()->back();
        }
    }

    public function changeEncryptedPassword(Request $rqt){
        $password = $rqt->password;
        $confirm_password = $rqt->confirm_password;

        if($password != $confirm_password){
            return redirect()->back()->with('error', 'Passwords are missmatch');
        }
        
        registration::where('student_id', Session::get('student_id'))
            ->update([
                'password' => Hash::make($password)
            ]);
        return redirect()->back()->with('success', 'Password is updated successfully');
    }

    public function enrollment(){
        $session_name = SessionInfo::where('status', 'Active')->get();
        $course_info = course::get();
        $semester_1st = course::where('semester', '1st')->count(); 
        $semester_2nd = course::where('semester', '2nd')->count(); 
        $semester_3rd = course::where('semester', '3rd')->count(); 
        $semester_4th = course::where('semester', '4th')->count(); 
        $semester_5th = course::where('semester', '5th')->count(); 
        $semester_6th = course::where('semester', '6th')->count(); 
        $semester_7th = course::where('semester', '7th')->count(); 

        // dd(gettype($semester_2nd));
        // dd($semester_2nd+$semester_3rd);
        return view('student.pages.enrollment', [
            'session_name_info' => $session_name,
            'course_info' => $course_info,
            'semester_1st' => $semester_1st,
            'sum_2nd' => $semester_1st+$semester_2nd,
            'sum_3rd' => $semester_1st+$semester_2nd+$semester_3rd,
            'sum_4th' => $semester_1st+$semester_2nd+$semester_3rd+$semester_4th,
            'sum_5th' => $semester_1st+$semester_2nd+$semester_3rd+$semester_4th+$semester_5th,
            'sum_6th' => $semester_1st+$semester_2nd+$semester_3rd+$semester_4th+$semester_5th+$semester_6th,
            'sum_7th' => $semester_1st+$semester_2nd+$semester_3rd+$semester_4th+$semester_5th+$semester_6th+$semester_7th
        ]);
    }

    public function storeEnrollment(Request $rqt){
        $course_id = $rqt->course_id;
        $student_type = $rqt->student_type;
        $session_name = $rqt->session_name;
        $semester_1 = $semester_2 = $semester_3 = $semester_4 = $semester_5 = $semester_6 = $semester_7 = $semester_8 = 0;

        if($course_id == ''){
            return redirect()->back()->with('error', 'Enrollment is ungratifield due to missing course id');
        }
    
        for($i=0; $i<count($course_id); $i++){
            $which_semester = course::select('semester')->where('id' , $course_id[$i])->first();
            if($which_semester->semester == '1st'){
                $semester_1++;
            }
            if($which_semester->semester == '2nd'){
                $semester_2++;
            }
            if($which_semester->semester == '3rd'){
                $semester_3++;
            }
            if($which_semester->semester == '4th'){
                $semester_4++;
            }
            if($which_semester->semester == '5th'){
                $semester_5++;
            }
            if($which_semester->semester == '6th'){
                $semester_6++;
            }
            if($which_semester->semester == '7th'){
                $semester_7++;
            }
            if($which_semester->semester == '8th'){
                $semester_8++;
            }
        }
        
        $arr = ['1semester' => $semester_1, '2semester' => $semester_2, '3semester' => $semester_3,'4semester' => $semester_4, 
                '5semester' => $semester_5, '6semester' => $semester_6, '7semester' => $semester_7, '8semester' => $semester_8];        
        $max_semester = array_keys($arr, max($arr));

        $student_type = array_filter($student_type); // remove null values
        $student_types = array_values($student_type); // start an array with different index to index 0

        $session_arr = [];
        $student_id_arr = [];
        $student_type_arr = [];
        $get_student_id = Session::get('student_id');

        for($i=0; $i<count($course_id); $i++){
            array_push($session_arr, $session_name);
            array_push($student_id_arr, intval($get_student_id));

            if($student_types[$i] == 'Recourse'){
                array_push($student_type_arr, $student_types[$i].implode($max_semester)); // implode for convert max_semester(string) to array
            }else{
                array_push($student_type_arr, $student_types[$i]);
            }

            enrollment::insert([
                'student_id' => $student_id_arr[$i],
                'course_id' => intval($course_id[$i]),
                'type' => $student_type_arr[$i],
                'session_name' => $session_arr[$i]
            ]);
        }

        return redirect()->back()->with('success', 'Your enrollment has been recorded');
    }

    public function pendingEnrollment(){
        $data = enrollment::where('student_id', intval(Session::get('student_id')))->get();
        return view('student.pages.pendingEnrollment', ['enrollment_info' => $data]);
    }

    public function deleteEnrollment($id){
        $decrypt_id = Crypt::decryptString($id);
        $deleted_data = enrollment::where('id', $decrypt_id)->first();
        $deleted_course_name = course::where('id', $deleted_data->course_id)->first();
        enrollment::where('id', $decrypt_id)->delete();
        return redirect()->back()->with('subject_name', $deleted_course_name->course_name.' deleted successfully');
    }

    public function deleteAllEnrollment(){
        enrollment::where('student_id', Session::get('student_id'))->delete();
        return redirect()->back();
    }
    // End of student information

    // Preenrollment
    public function preEnrollment(){
        $data = enrollment::select('course_id', 'type', DB::raw('count(*) as total'))->groupBy('course_id', 'type')
        ->where('type', '!=', 'Regular')
        ->orderBy('total', 'desc')
        ->get('total', 'course_id', 'type');
        
        return view('admin.pages.preEnrollment', compact('data'));
    }

    public function viewPdf(){
        $data = enrollment::select('course_id', 'type', DB::raw('count(*) as total'))
            ->groupBy('course_id', 'type')
            ->where('type', '!=', 'Regular')
            ->orderBy('total', 'desc')
            ->get('total', 'course_id', 'type');

        $pdf = PDF::loadView('admin.pages.pdf.viewPdf', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function generatePdf(){
        $data = enrollment::select('course_id', 'type', DB::raw('count(*) as total'))
            ->groupBy('course_id', 'type')
            ->where('type', '!=', 'Regular')
            ->orderBy('total', 'desc')
            ->get('total', 'course_id', 'type');

        $pdf = PDF::loadView('admin.pages.pdf.pdfPreEnrollment', compact('data'));
        return $pdf->download('preEnrollmentDetails.pdf');
    }

    public function export(){
        return Excel::download(new PreEnrollmentExport, 'preEnrollmentDetails.xlsx');
    }
    // End of PreEnrollment
}
