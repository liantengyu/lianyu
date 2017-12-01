<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Input; 
use App\Models\User; 

class UserController extends Controller
{
    
    function login_check(){

    	$data = Input::get();
    	
    	$userinfo=User::where(['user' => $data['user'], 'pwd' => $data['pwd']])->first()->toArray();

    	session::put('user_id', $userinfo['id']);
    	if ($userinfo) {
    		return redirect('plan/add');
    	}
    	
    }

}
