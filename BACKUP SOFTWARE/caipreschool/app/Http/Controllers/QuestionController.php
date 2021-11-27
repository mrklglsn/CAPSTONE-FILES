<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Question;
use App\Models\Choice;
use App\Models\Quiz;
use DataTables;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
        $choice1 = "";
        $choice2 = "";
        $choice3 = "";
        $questionImage = "";
        //Validate request
        if($request->type == 1){
            $request -> validate([
                'question' => 'required',
                'type' => 'required',
                'choice1' => 'required',
                'choice2' => 'required',
                'choice3' => 'required',
                'answer' => 'required',
            ]);

            $choice1 = $request->choice1;
            $choice2 = $request->choice2;
            $choice3 = $request->choice3;

        }
        else if($request->type == 2){
            $request -> validate([
                'question' => 'required',
                'type' => 'required',
                'choice4' => 'required',
                'choice5' => 'required',
                'choice6' => 'required',
                'answer' => 'required',
            ]);
            
            $choice1 = uniqid()."-".$request->file('choice4')->getClientOriginalName();
            $choice2 = uniqid()."-".$request->file('choice5')->getClientOriginalName();
            $choice3 = uniqid()."-".$request->file('choice6')->getClientOriginalName();

            $request->file('choice4')->storeAs('public/images',$choice1);
            $request->file('choice5')->storeAs('public/images',$choice2);
            $request->file('choice6')->storeAs('public/images',$choice3);
            
        }
        
        if ($request->file('photo')) {
            $questionImage = uniqid()."-".$request->file('photo')->getClientOriginalName();

            $request->file('photo')->storeAs('public/images',$questionImage);
        }
        //Insert question data
        if(Question::updateOrCreate(['id' => $request->question_id],['quiz_id' => session()->get('quiz_id'), 
        'question' => $request->question, 'question_image' => $questionImage, 'question_type' => $request->type])){
            if($request->question_id == ""){
                $lastInsertData = Question::orderBy('id', 'desc')->take(1)->first();
            }
            else{
                $lastInsertData = Question::withTrashed()->where('id', '=', $request->question_id )->first();
            }
            
            //Insert choices to database
            if(Choice::updateOrCreate(['question_id' => $request->question_id], ['question_id'=>$lastInsertData->id,
                'choice1'=>$choice1,'choice2'=>$choice2,'choice3'=>$choice3,
                'answer_index'=>$request->answer])){
                return response()->json(['success'=>'Question added successfully']);    
            }
        }
         else{
             return response()->json(['error'=>'Please enter a valid question details']);
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
        $question =Question::withTrashed()
        ->select('*','questions.id AS questions_id_num')
        ->leftJoin('choices', 'questions.id', '=', 'choices.question_id')
        ->where('questions.id', $id)->first();

        return response()->json($question);

        dd($question);
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
        Question::find($id)->delete();
        Choice::where('question_id', $id)->first()->delete();
        return response()->json(['success'=>'Question deleted successfully.']);
    }
}
