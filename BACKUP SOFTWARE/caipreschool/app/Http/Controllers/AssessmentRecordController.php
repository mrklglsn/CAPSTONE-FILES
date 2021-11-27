<?php

namespace App\Http\Controllers;
use App\Models\Assessment_records;
use Illuminate\Http\Request;
use DataTables;
class AssessmentRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $assessment_log =   Assessment_records::withTrashed()
                ->select('*','students.id AS student_id', 'assessment_records.created_at AS finished_at')
                ->leftJoin('quizzes', 'assessment_records.assessment_id', '=', 'quizzes.id')
                ->leftJoin('students', 'assessment_records.student_id', '=', 'students.id')
                ->where('assessment_records.student_id', '=', session()->get('viewStudent'))
                ->get();
        if ($request->ajax()) {
            return Datatables::of($assessment_log)
                    ->addIndexColumn()
                    ->addColumn('starsCount', function($row){
                        if($row->stars_count == 1)
                            $btn = '<i class="fa fa-star text-warning"></i>';
                        else if($row->stars_count == 2)
                            $btn = '<i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>';
                        else if($row->stars_count == 3)
                            $btn = '<i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>';
                        return $btn;
                    })
                    ->rawColumns(['starsCount'])
                    ->make(true);
        }
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
        date_default_timezone_set("Asia/Manila");
        //Insert data
        if(Assessment_records::updateOrCreate(['id' => $request->id],['assessment_id' => $request->assessment_id, 
            'stars_count' => $request->stars_count, 'student_id' => session()->get('LoggedStudent')])){ 

            return response()->json(['success'=>'Faqs saved successfully.']);
        }
        else{
            return response()->json(['error'=>'Please enter a valid faqs details']);
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
        //
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
        //
    }
}
