<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DataTables;
     /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the function users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
class ParentController extends Controller
{
    function index(Request $request){
        $users = User::withTrashed()->where('is_admin', 0)->get();
        
        if ($request->ajax()) {
            
            return Datatables::of($users)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        
                        $btn = '<btn class="btn bg-success btn-sm text-white editParent" id="editParentBtn"  data-toggle="modal" data-target="#modalEditParent" data-id= '.$row->id.' ><i class ="fa fa-edit mr-1"></i>Edit</btn>';
                        if($row->deleted_at != null)
                            $btn = $btn.'<btn class="btn bg-primary btn-sm text-white recoverParent" data-toggle="modal" data-target="#modalRecoverParent" data-id='.$row->id.' ><i class ="fa fa-trash mr-1"></i>Recover</btn>';
                        else
                            $btn = $btn.'<btn class="btn bg-danger btn-sm text-white deleteParent" data-toggle="modal" data-target="#modalRecoverParent" data-id='.$row->id.' ><i class ="fa fa-trash mr-1"></i>Delete</btn>';
    
                            return $btn;
                    })
                    ->make(true);
        }
        
        return view('admin.parentmanage',compact('users'));
    }

    function show($id){
        $user = DB::table('users')->where('id', $id)->first();
        return response()->json($user);
    }
    
    function store(Request $request){
        User::updateOrCreate(['id' => $request->id],
            [   'username' => $request->username, 
                'full_name' => $request->fullname,
                'email' => $request->email,
            ]);        
   
        return response()->json(['success'=>'Parent details saved successfully.']);
    }

    function destroy($id){
        User::find($id)->delete();
        
        return response()->json(['success'=>'Parent account deleted successfully.']);
    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();

        return response()->json(['success'=>'Parent account restored successfully.']);
    }

    public function restore_all()
    {
        User::onlyTrashed()->restore();

        return back()->with('success', 'All Parent Accounts Restored successfully');
    }

}
