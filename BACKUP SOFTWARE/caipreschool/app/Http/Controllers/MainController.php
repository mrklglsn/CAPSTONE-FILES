<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
     /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
class MainController extends Controller
{
    function login(){
        return view('auth.login');
    }

    function register(){
        return view('auth.register');
    }

    function save(Request $request){
        //Validate request
        $request -> validate([
            'username' => 'required|unique:users',
            'full_name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email|unique:users',
            'contact_number' => 'required|digits:11|regex:/^([0-9\s\-\+\(\)]*)$/',
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                ->mixedCase()
                ->numbers()
                ],
        ]);
        
        //Insert data
        $User = new User;
        $User->username = $request->username;
        $User->full_name = $request->full_name;
        $User->email = $request->email;
        $User->contact_number = $request->contact_number;
        $User->password = Hash::make($request->password);
        $User->is_admin = '0';
        $User->photo_file_name = 'avatar.jpg';
        $save = $User->save();

        if($save){
            return back()->with('success', 'Registration success!');
        }
        else{
            return back()->with('fail', 'Something went wrong, please try again');
        }
    }
}
