<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
        if(Auth::check() && auth()->user()->type == 'admin'){
            return redirect('/students');
        }elseif(Auth::check() && auth()->user()->type == 'user'){
            return redirect('/verstu');
        }
        return view('auth.login');
    }

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function login(LoginRequest $request){
        $credentials = $request->getCredentials();

        // if(!Auth::validate($credentials)){
        //     return redirect()->to('/login')->withErrors('Login failed');
        // }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

            if(auth()->user()->type == 'admin'){
                return redirect()->route('students.index');
            }elseif(auth()->user()->type == 'user'){
                return redirect()->to('/verstu');
            }else{
                return redirect()->to('/login')->withErrors('Login failed');
            }

        // return $this->authenticated($request, $user);
    }

    public function authenticated(Request $request, $user){
        return redirect('/students');
    }
}
