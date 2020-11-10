<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Database;

class DashboardController extends Controller
{
    private static $current_user_uid ;
    
    public function login(Request $request) {
        
        $email = $request->input('email');
        $password = $request->input('password');
        
        $auth = app('firebase.auth');
        
        try{
            
            $user = $auth->signInWithEmailAndPassword($email, $password);
            $data = $user->data();
            session(['current_user_id' => $data['localId']]);
            
        } catch(\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e){
            return redirect()->route('welcome')->with('status', 'error');
        }
        
        return redirect()->route('dashboard');
    }
    
    public function logout(){
        
    }
    
    public function index()
    {
        $db = app('firebase.database');
        $uid = session()->get('current_user_id');
        $user = $db->getReference('users/'.$uid )->getValue();
        return view('dashboard',compact('user'));
    }
    
}
