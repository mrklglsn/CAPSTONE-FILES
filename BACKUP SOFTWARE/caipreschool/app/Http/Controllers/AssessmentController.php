<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use DataTables;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //SQL FOR GETTING ALL QUIZ RECORDS FROM THE DATABASE
        $quiz =  Quiz::withTrashed()
                ->select('*','quizzes.deleted_at AS quiz_deleted_at', 'quizzes.id AS assessment_id',
                            DB::raw('count(questions.quiz_id) as numOfQuestion'))
                ->leftJoin('questions', 'quizzes.id', '=', 'questions.quiz_id')
                ->groupBy('quizzes.title')
                ->get();

        if ($request->ajax()) {
            return Datatables::of($quiz)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a class="btn bg-success btn-sm text-white manageAssessment" href="'.route('assessments.manage', $row->assessment_id).'"><i class="fa fa-task"></i> Manage</a>';
                        $btn = $btn.'<btn class="btn bg-success btn-sm text-white editAssessment" data-toggle="modal" data-target="#modalAssessment" data-id= '.$row->assessment_id.' ><i class ="fa fa-edit mr-1"></i>Edit</btn>';
                        if($row->quiz_deleted_at != null)
                            $btn = $btn.'<btn class="btn bg-primary btn-sm text-white recoverAssessment" data-toggle="modal" data-target="#modalActionAssessment" data-id='.$row->assessment_id.' ><i class ="fa fa-trash mr-1"></i>Recover</btn>';
                        else
                            $btn = $btn.'<btn class="btn bg-danger btn-sm text-white deleteAssessment" data-toggle="modal" data-target="#modalActionAssessment" data-id='.$row->assessment_id.' ><i class ="fa fa-trash mr-1"></i>Delete</btn>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.assessment_manage',compact('announcement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate request
        $request -> validate([
            'title' => 'required',
            'subject' => 'required',
        ]);
       
        //Insert data
        if(Quiz::updateOrCreate(['quizzes.id' => $request->quiz_id],['title' => $request->title, 
            'subject' => $request->subject])){ 
            return response()->json(['success'=>'Quiz saved successfully.']);
        }
        else{
            return response()->json(['error'=>'Please enter a valid quiz details']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = DB::table('quizzes')->where('id', $id)->first();
        return response()->json($quiz);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Quiz::find($id)->delete();
        return response()->json(['success'=>'Faqs deleted successfully.']);
    }

    public function restore($id)
    {
        Quiz::withTrashed()->find($id)->restore();

        return response()->json(['success'=>'Faqs restored successfully.']);
    }

    public function manageQuestions($id,Request $request){

        $quiz =  Quiz::withTrashed()->find($id);
        $questions =  Question::withTrashed()
        ->select('*','questions.id AS question_id','questions.deleted_at AS questions_deleted_at')
        ->leftJoin('choices', 'choices.question_id', '=', 'questions.id')
        ->where('questions.quiz_id', '=', $quiz->id )
        ->where('questions.deleted_at', '=', null)
        ->get();

        if(session()->has('quiz_id')){
            session()->pull('quiz_id');
        }
        $request->session()->put('quiz_id', $id);
      
        return view('admin.question_management', compact('quiz','questions'));
    }
}
