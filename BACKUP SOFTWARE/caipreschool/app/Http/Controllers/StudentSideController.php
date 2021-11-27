<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Quiz;

class StudentSideController extends Controller
{
    function home(Request $request, $student_id){
        $student = Student::where('parent_id', '=', session('LoggedUser'))
                            ->where('id', '=',  $student_id)->first();
        if(session()->has('LoggedStudent')){
            session()->pull('LoggedStudent');
        } 
        $request->session()->put('LoggedStudent', $student_id);
        
        return view('student.student_home', compact('student'));
    }

    function viewEnglishArea(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        $quizzes = Quiz::withTrashed()
                ->where('deleted_at', '=', null)
                ->where('subject', '=', "English")
                ->get();
        return view('student.english_area', compact('students','quizzes'));
    }

    function viewMathArea(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        $quizzes = Quiz::withTrashed()
                ->where('deleted_at', '=', null)
                ->where('subject', '=', "Math")
                ->get();
        return view('student.math_area', compact('students','quizzes'));
    }

    function viewScienceArea(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        $quizzes = Quiz::withTrashed()
                ->where('deleted_at', '=', null)
                ->where('subject', '=', "Science")
                ->get();
        return view('student.science_area', compact('students','quizzes'));
    }

    

    


}
