<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request -> validate([
            'username' => 'required',
            'edit_full_name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email',
        ]);
      
        //Insert data
        if(User::updateOrCreate(['id' => $request->edit_id],
            ['full_name' => $request->edit_full_name, 'username' => $request->username, 'email' => $request->email])){ 
            return response()->json(['success'=>'User details saved successfully.']);
        }
        else{
            return response()->json(['error'=>'Please enter a valid user details']);
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
    
    function adminProfile(){

        $userInfo = User::where('id', '=', session()->get('LoggedUser'))->first();

        return view('admin.profile', compact('userInfo'));
    }
}