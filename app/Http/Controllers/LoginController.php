<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login(Request $request) {

      
            
            if (Auth::attempt (array(

                'email' => $request->post('email'),
                
                'password' => $request->post('password'),
                
                
            ),true)) {

                return redirect()->intended('/');

            } else {
               
            }
    }

    function register(Request $request) {

        $user = User::create(array(

            'email' => $request->post('email'),
            'name' => $request->post('name'),
            'password' => $request->post('password')
            
            ));
            
        
}



    function showlogin() {
       return view("login",["x"=>Auth::check()]);
    }

    function showregister() {
        return view("register");
     }

}
