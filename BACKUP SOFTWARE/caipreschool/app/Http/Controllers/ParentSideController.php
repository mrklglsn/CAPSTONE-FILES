<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
     /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | This controller redirects admin to their page. The controller uses a trait
    | to conveniently provide its functionality to admin functions.
    |
    */
class ParentSideController extends Controller
{
    function home(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        return view('parent.home', compact('students'));
    }

    function profile($LoggedUser){
        $user = User::where('id', '=', $LoggedUser)->first();
        $students = Student::where('parent_id', '=', $LoggedUser)->get();
        return view('parent.overview', compact(['user', 'students']));
    }

    function editProfile($LoggedUser){
        $user = User::where('id', '=', $LoggedUser)->first();
        return view('parent.edit_profile', compact('user'));
    }

    function addStudent(){
        return view('parent.add_profile');
    }

    function addNewStudent(Request $request){
        //Validate request
        $request -> validate([
            'fullName' => 'required|regex:/^[a-zA-Z\s]*$/',
            'nickName' => 'required|regex:/^[a-zA-Z\s]*$/',
            'birthDate' => 'required|date',
            'photo' => 'required',
            'imagename' => 'required',
        ]);

        if ($request->file('photo')) {
            $folderPath = public_path('storage/images/');
            $image_parts = explode(";base64,", $request->imagename);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_base64 = base64_decode($image_parts[1]);
            $file =  uniqid() . '.png';
            
            file_put_contents($folderPath. $file, $image_base64);
        }
        else{
            $file = "user1.png";
        }

        if(Student::updateOrCreate(['id' => $request->student_id],['student_name' => $request->fullName, 'nickname' => $request->nickName,
            'birth_date' => $request->birthDate, 'profile_pic' => $file, 'parent_id' => session('LoggedUser')])){
            return response()->json(['success'=>'New student profile saved successfully.']); 
        }
        else{
            return response()->json(['fail'=>'Adding profile failed'],422); 
        }

    }
    
    function editStudent($student_id){
        $student = Student::where('parent_id', '=', session('LoggedUser'))
                            ->where('id', '=',  $student_id)->first();
        
        return view('parent.edit_student', compact('student'));
    }

    function viewStudent($student_id,Request $request){
        $student = Student::where('parent_id', '=', session('LoggedUser'))
                            ->where('id', '=',  $student_id)->first();
        if(session()->has('viewStudent')){
            session()->pull('viewStudent');
        } 
        $request->session()->put('viewStudent', $student_id);
        return view('parent.studentlog', compact('student'));
    }

}

