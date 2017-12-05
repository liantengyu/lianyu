<?php

namespace frontend\controllers;

use yii;
use yii\web\Controller;
use yii\helpers\Url;

use frontend\models\Calendar;
use frontend\models\CalenUser;



class CalendarController extends Controller
{
	public $user_id = '';

	public function init(){
		$session = \Yii::$app->session;
		if ($session->get('user_id')) {
		 	$this->user_id = $session->get('user_id'); 
		} 
	}


	

    public function actionIndex()
    {	

    	

    	if (!$this->user_id) {

    		return $this->redirect(['login']);

    	}else{
    		return $this->render('index');
    	}
   
    }

    public function actionLogin()
    {
    	
    	if (!$_POST) {
    		$model = new CalenUser;
    		return $this->render('login',['model' => $model]);
    	}else{
    		$data = Yii::$app->request->post();
			$data = $data['CalenUser'];
    		$userinfo = CalenUser::find()->where(['user' => $data['user'], 'pwd' => $data['pwd']])->asArray()->one();
    		
    		if ($userinfo) {

    			$session = \Yii::$app->session;
				$session->set('user_id',$userinfo['id']);  

    			return $this->redirect(['index']);
    		}else{
    			return $this->render('login', ['model' => $model,]);
    		}
    	}

        
    }


    public function actionSign(){
    	$date = Yii::$app->request->get('date');

    	$calendar = new Calendar;

    	$calendar->user_id = $this->user_id;
    	// 获取连续签到天数  查询签到的前一天连续签到天数
    	$pre_day_data = $this->get_pre_day($date);

    	// 如果数据存在则获取上一天的签到天数及金币
    	if ($pre_day_data) {

		
    		$pre_day = intval($pre_day_data['days']+1);
			$calendar->days = $pre_day;

    		if ($pre_day >= 1 && $pre_day <= 5) {
				$money = $pre_day;

    		}else{

    			if ($pre_day > 5 && $pre_day < 60) {
    				$money = 5;
	    		}

	    		if ($pre_day % 60 == 0) {
	    			$money = 105;
	    		}

	    		if ($pre_day % 60 != 0) {
	    			$money = 5;
	    		}
    		} 		

    	}else{
    		$calendar->days = 1;
    		$money = 1;
    	}
    	
    	$calendar->money = $money;
    	$calendar->date = $date;

    	$res = $calendar->save();

    	if ($res) {
    		$userinfo = CalenUser::find()->where(['id' => $this->user_id])->asArray()->one();

    		$calenuser = CalenUser::find()->where(['id' => $this->user_id])->one();
    		$calenuser->money = intval($userinfo['money']+$money);
    		$calenuser->save();
    	}

    	$data = $this->Auto();
    	echo json_encode($data);
    }

    // 补签处理
    public function actionSigned(){
    	// 查询金币是否够补签
    	$userinfo = CalenUser::find()->where(['id' => $this->user_id])->asArray()->one();
    	if ($userinfo['money'] < 5) {
    		echo json_encode(0);die;
    	}

    	// 扣除金币
    	$calenuser = CalenUser::find()->where(['id' => $this->user_id])->one();
		$calenuser->money = intval($userinfo['money']-5);
		$calenuser->save();

    	$date = Yii::$app->request->get('date');

    	$calendar = new Calendar;

    	$calendar->user_id = $this->user_id;

    	// 获取前一天的数据 如果不存在数据则表明本次补签数据为第一天
    	// 然后查询后面一天的数据  如果存在则本次第一天 后面一天修改为第二天 
    	// 若后面还有数据依次循环
    	$pre_day_data = $this->get_pre_day($date);

    	// 获取连续签到天数  查询签到的前一天连续签到天数
		$pre_day = intval($pre_day_data ? $pre_day_data['days']+1 : 1);

		
    	// 1.前一天数据存在 按前面连续签到天生递增

    	$calendar->days = $pre_day;
 
		$calendar->money = 0;
    	$calendar->date = $date;

    	$calendar->save();

		// 如果此时后一天也存在数据 则循环修改
    	if ($this->get_next_day($date)) {

    		// 查询大于当前时间的签到天数
			$next_day_data_all = $this->get_next_day_all($date);

			if ($next_day_data_all) {

			$arr_count = count($next_day_data_all);
			
				for ($i=0; $i < $arr_count ; $i++) { 

			    	// 获取连续签到天数  查询签到的前一天连续签到天数

					$day = 60*60*24;

					$next_day_data = $this->get_next_day($date+$day*$i);

					if (empty($next_day_data)) break;

					$update = Calendar::find()->where(['user_id' => $this->user_id, 'id' => $next_day_data_all[$i]['id']])->one();
					$update->days = ++$pre_day;
					$res = $update->save();	

				}
			
			}
    	}

    	// 获取更新后数据
    	$data = $this->Auto();
    	echo json_encode($data);	
    	  	
    }


    public function get_pre_day($date){
    	// 查询上一天数据
    	$date = $date-60*60*24;
    	// var_dump($date);die;
    	$calendar = Calendar::find()->where(['date' => $date, 'user_id' => $this->user_id])->asArray()->one();
    	return $calendar;
    }

    public function get_next_day($date){
    	
    	$date = $date+60*60*24;
    	// // var_dump($date);die;
    	$calendar = Calendar::find()->where(['date' => $date, 'user_id' => $this->user_id])->asArray()->one();
    	return $calendar;
    }

    public function get_next_day_all($date){
    	// 查询大于当前天所有数据

    	$calendar = Calendar::find()->where("date > ".$date)->orderBy('id DESC')->asArray()->all();
    	return $calendar;
    }


    /** [actionGet_sgin_all 获取已经签到的全部数据] */
    public function actionGet_sgin_all(){
    	$calendar = Calendar::find()->select('date')->where(['user_id' => $this->user_id])->asArray()->all();

    	echo json_encode($calendar);

    }

    /** [actionGet_sgin_all 获取已经签到的全部数据] */
    public function actionAuto(){
    	$data = $this->Auto();
    	echo json_encode($data);

    }

    public function Auto(){
    	$data = Calendar::find()->orderBy('date DESC')->where(['user_id' => $this->user_id])->asArray()->one();
    	$money = CalenUser::find()->select('money,user')->where(['id' => $this->user_id])->asArray()->one();

    	$data['user_money'] = $money['money'];
    	$data['user'] = $money['user'];
    	return $data;
    }
}
