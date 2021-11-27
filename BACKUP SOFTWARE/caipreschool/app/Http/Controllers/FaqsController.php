<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Faqs;
use DataTables;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faqs =  Faqs::withTrashed()
                        ->select('*','faqs.deleted_at AS faqs_deleted_at')
                        ->leftJoin('users', 'users.id', '=', 'faqs.added_by')
                        ->get();

        if ($request->ajax()) {
            return Datatables::of($faqs)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<btn class="btn bg-success btn-sm text-white editFaqs" data-toggle="modal" data-target="#modalFaqs" data-id= '.$row->id.' ><i class ="fa fa-edit mr-1"></i>Edit</btn>';
                        if($row->faqs_deleted_at != null)
                            $btn = $btn.'<btn class="btn bg-primary btn-sm text-white recoverFaqs" data-toggle="modal" data-target="#modalActionFaqs" data-id='.$row->id.' ><i class ="fa fa-trash mr-1"></i>Recover</btn>';
                        else
                            $btn = $btn.'<btn class="btn bg-danger btn-sm text-white deleteFaqs" data-toggle="modal" data-target="#modalActionFaqs" data-id='.$row->id.' ><i class ="fa fa-trash mr-1"></i>Delete</btn>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.faqmanage',compact('faqs'));
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
            'faqs_question' => 'required',
            'faqs_answer' => 'required',
        ]);
       
        //Insert data
        if(Faqs::updateOrCreate(['id' => $request->faqs_id],['faqs_question' => $request->faqs_question, 
            'faqs_answer' => $request->input('faqs_answer'), 'added_by' => session()->get('LoggedUser')])){ 

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
        $faqs = DB::table('faqs')->where('id', $id)->first();
        return response()->json($faqs);
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
        Faqs::find($id)->delete();
        return response()->json(['success'=>'Faqs deleted successfully.']);
    }

    public function restore($id)
    {
        Faqs::withTrashed()->find($id)->restore();

        return response()->json(['success'=>'Faqs restored successfully.']);
    }
}
