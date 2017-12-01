<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Input; 
use App\Models\PlanRemind;
use Illuminate\Support\Facades\Redis; 

class PlanRemindController extends Controller
{
    	
    function create(){

    	$len = Redis::Llen('plan');

    	if ($len > 0) {
    		for ($i=0; $i <$len ; $i++) { 
    			$data = Redis::Lpop('plan');
    			PlanRemind::create(unserialize($data));
    		}
    	}


    	
    }

}
