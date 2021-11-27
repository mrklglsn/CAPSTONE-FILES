<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Quiz;
use App\Models\Question;

class GameController extends Controller
{
    function game1(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        return view('student.games.english.letter_guessing1', compact('students'));
    }

    function game3(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        return view('student.games.english.line_connect', compact('students'));
    }

    function openTriangleTracing(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        return view('student.games.math.triangle_tracing', compact('students'));
    }

    function openCountingObject(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        return view('student.games.math.counting_objects', compact('students'));
    }

    function openChoosingLetter(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        return view('student.games.english.choose_letter', compact('students'));
    }

    function openChoosingAnimalNames(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        return view('student.games.science.animal_names', compact('students'));
    }

    function openMatchingAnimalSounds(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        return view('student.games.science.animal_sounds', compact('students'));
    }

    function openMatchingShapes(){
        $students = Student::where('parent_id', '=', session('LoggedUser'))->get();
        return view('student.games.math.matching_shapes', compact('students'));
    }

    function openAssessment($id){
        $quiz =  Quiz::withTrashed()->find($id);
        $questions =  Question::withTrashed()
        ->select('*','questions.deleted_at AS questions_deleted_at')
        ->leftJoin('choices', 'choices.question_id', '=', 'questions.id')
        ->where('questions.quiz_id', '=', $id )
        ->where('questions.deleted_at', '=', null)
        ->get();
        return view('student.assessment_area', compact('quiz','questions'));
    }
}
