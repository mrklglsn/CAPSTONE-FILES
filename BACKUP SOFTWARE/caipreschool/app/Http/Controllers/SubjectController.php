<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use DataTables;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects =  Subject::withTrashed()->get();

        if ($request->ajax()) {
            return Datatables::of($subjects)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<btn class="btn bg-success btn-sm text-white manageAssessments" data-toggle="modal" data-target="#modalSubject" data-id= '.$row->id.' >Manage Assessment</btn>';
                        $btn = $btn.'<btn class="btn bg-success btn-sm text-white editSubject" data-toggle="modal" data-target="#modalSubject" data-id= '.$row->id.' ><i class ="fa fa-edit mr-1"></i>Edit</btn>';
                        if($row->deleted_at != null)
                            $btn = $btn.'<btn class="btn bg-primary btn-sm text-white recoverSubject" data-toggle="modal" data-target="#modalActionSubject" data-id='.$row->id.' ><i class ="fa fa-trash mr-1"></i>Recover</btn>';
                        else
                            $btn = $btn.'<btn class="btn bg-danger btn-sm text-white deleteSubject" data-toggle="modal" data-target="#modalActionSubject" data-id='.$row->id.' ><i class ="fa fa-trash mr-1"></i>Delete</btn>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.subjectmanage',compact('subjects'));
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
            'subject_name' => 'unique:subjects|required|regex:/^[a-zA-Z\s]*$/',
        ]);

        //Insert data
        if(Subject::updateOrCreate(['id' => $request->subject_id],
            ['subject_name' => $request->subject_name])){
            return response()->json(['success'=>'Book saved successfully.']);
        }
        else{
            return response()->json(['error'=>'Please enter a valid subject name']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $subjects = DB::table('subjects')->where('id', $id)->first();
        return response()->json($subjects);
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
        Subject::find($id)->delete();
        return response()->json(['success'=>'Subject deleted successfully.']);
    }

    public function restore($id)
    {
        Subject::withTrashed()->find($id)->restore();

        return response()->json(['success'=>'Subject restored successfully.']);
    }
}
