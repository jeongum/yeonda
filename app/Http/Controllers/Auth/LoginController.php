<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception;

class LoginController extends Controller
{
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $current_user_uid ;
    
    public function login(Request $request) {
        
        $email = $request->input('email');
        $password = $request->input('password');
        
        // Launch Firebase Auth
        $auth = app('firebase.auth');
        
        try{
            
            $user = $auth->signInWithEmailAndPassword($email, $password);
            $data = $user->data();
            $this->current_user_uid = $data['localId'];
            
            
        } catch(\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e){
            return redirect()->route('welcome')->with('status', 'error');
        }
        
        return redirect()->route('dashboard');
    }
    
//     public function __construct()
//     {
//         $this->middleware('guest')->except('logout');
//     }
    public function getCurrentUser(){
        return $this->current_user_uid;
    }
}
