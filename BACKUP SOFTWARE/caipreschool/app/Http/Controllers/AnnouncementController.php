<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Announcement;
use DataTables;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $announcement =  Announcement::withTrashed()
                        ->select('*','announcements.deleted_at AS announcements_deleted_at')
                        ->leftJoin('users', 'users.id', '=', 'announcements.added_by')
                        ->get();

        if ($request->ajax()) {
            return Datatables::of($announcement)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<btn class="btn bg-success btn-sm text-white editAnnouncement" data-toggle="modal" data-target="#modalAnnouncement" data-id= '.$row->id.' ><i class ="fa fa-edit mr-1"></i>Edit</btn>';
                        if($row->announcements_deleted_at != null)
                            $btn = $btn.'<btn class="btn bg-primary btn-sm text-white recoverAnnouncement" data-toggle="modal" data-target="#modalActionAnnouncement" data-id='.$row->id.' ><i class ="fa fa-trash mr-1"></i>Recover</btn>';
                        else
                            $btn = $btn.'<btn class="btn bg-danger btn-sm text-white deleteAnnouncement" data-toggle="modal" data-target="#modalActionAnnouncement" data-id='.$row->id.' ><i class ="fa fa-trash mr-1"></i>Delete</btn>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.announcemanagement',compact('announcement'));
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
            'announcement_header' => 'required',
            'announcement_statement' => 'required',
        ]);
       
        //Insert data
        if(Announcement::updateOrCreate(['id' => $request->announcement_id],
            ['announcement_header' => $request->announcement_header, 'announcement_statement' => $request->announcement_statement, 'added_by' => session()->get('LoggedUser')])){ 
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
    public function show($id)
    {
        $announcement = DB::table('announcements')->where('id', $id)->first();
        return response()->json($announcement);
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
     * Soft delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Announcement::find($id)->delete();
        return response()->json(['success'=>'Announcement deleted successfully.']);
    }

    //Restores a specific announcement
    public function restore($id)
    {
        Announcement::withTrashed()->find($id)->restore();

        return response()->json(['success'=>'Announcement restored successfully.']);
    }
}
