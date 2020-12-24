<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Database;

class TestController extends Controller
{
    public function test(){
        $auth = app('firebase.auth');
        
        $uid = 'Xc4HFS1QaOZhLK8IqukGvLHACHP2';
        $additionalClaims = [
            'admin' => true
        ];
        
        return view('welcome');
    }
}
