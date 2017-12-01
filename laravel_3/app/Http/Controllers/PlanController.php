<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Redis; 

use Illuminate\Support\Facades\Input; 
use App\Models\Plan;

class PlanController extends Controller
{
    
    function add(){
    	return view('plan/add');
    }

    function create(){
    	
    	$data = Input::get();
    	$data['user_id'] = session()->get('user_id');

    	$plan = [
    		'content' => $data['content'],
    		'remind_time' => $data['remind_time'],
    		'user_id' => $data['user_id'],
    	];

    	$res = Plan::create($plan);

    	$plan['plan_id'] = $res->id;

    	Redis::lpush('plan',serialize($plan));

    	// return redirect('planremind/create');
    	
    }




}
