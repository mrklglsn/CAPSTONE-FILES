<?php

namespace App\Http\Controllers;

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
class LoginController extends Controller
{
    function login(Request $request){
         //Validate request
         $request -> validate([
            'username' => 'required',
            'password' => 'required|min:5|max:22'
        ]);

        $userInfo = User::where('username', '=', $request->username)->first();

        if(!$userInfo){
            return back()->with('fail', 'We do not recognize your username');
        }
        else{
            //check password
            if(Hash::check($request->password, $userInfo ->password)){
                $request->session()->put('LoggedUser', $userInfo->id);
                $request->session()->put('AccountName', $userInfo->full_name);
                
                if($userInfo->is_admin == 1){
                    return redirect('admin/dashboard');
                }
                else{
                    return redirect('parent/home');
                }
            }
            else{
                return back()->with('fail', 'Incorrect password');
            }
        }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect()->route('login');
        }
    }

}
