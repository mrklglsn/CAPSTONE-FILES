<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Video;
use DataTables;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $videos =  Video::withTrashed()->get();

        if($request->ajax()) {
            return Datatables::of($videos)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<btn class="btn bg-warning btn-sm text-white viewVideo" data-toggle="modal" data-target="#modalViewVideo" data-id= '.$row->id.' ><i class ="fa fa-edit mr-1"></i>View</btn>';
                    $btn = $btn.'<btn class="btn bg-success btn-sm text-white editVideo" data-toggle="modal" data-target="#modalVideoList" data-id= '.$row->id.' ><i class ="fa fa-edit mr-1"></i>Edit</btn>';
                    if($row->deleted_at != null)
                        $btn = $btn.'<btn class="btn bg-primary btn-sm text-white recoverVideo" data-toggle="modal" data-target="#modalActionVideo" data-id='.$row->id.' ><i class ="fa fa-trash mr-1"></i>Recover</btn>';
                    else
                        $btn = $btn.'<btn class="btn bg-danger btn-sm text-white deleteVideo" data-toggle="modal" data-target="#modalActionVideo" data-id='.$row->id.' ><i class ="fa fa-trash mr-1"></i>Delete</btn>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.videolist',compact('videos'));
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
        $thumbnailName ="";
        $videoName = "";
        if ($request->file('photo')) {
            $thumbnailName = $request->file('photo')->getClientOriginalName();

            $request->file('photo')->storeAs('public/images',$thumbnailName);

        }

        if ($request->file('video')) {
            $videoName = $request->file('video')->getClientOriginalName();

            $request->file('video')->storeAs('public/videos',$videoName);
        }
        
        if(Video::updateOrCreate(['id' => $request->video_id],['video_title' => $request->video_title, 
        'video_desc' => $request->video_desc, 'category' => $request->video_category,'video_thumbnail' => $thumbnailName,
        'video_file_name' => $videoName])){
            return response()->json(['success'=>'New video saved successfully.']); 
        }
        else{
            return response()->json(['error'=>'Please enter a valid video details']);
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
        $videos = DB::table('videos')->where('id', $id)->first();
        
        return response()->json($videos);
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
