<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Username;



class UsernameController extends Controller
{

    public function actionIndex()
    {
    	if (!$_POST) {
    		return $this->render('index');
    	}else{
    		$data = Yii::$app->request->post();


    	}
        
    }

    public function actionAdd()
    {
    	$model = new Username();

    	if (!$_POST) {
    		
	        return $this->render('add', ['model' => $model,]);
        }else{

        	$data = Yii::$app->request->post('Username');
                
           

        	$model->user = $data['user'];
        	$model->pwd = $data['pwd'];
        	$model->save();

        } 

    }

    public function actionLogin()
    {
		$model = new Username();
    	if (!$_POST) {
    		
    		return $this->render('login', ['model' => $model,]);
    	}else{
    		$data = Yii::$app->request->post('Username');

    		$userinfo = Username::find()->where(['user' => $data['user'], 'pwd' => $data['pwd']])->asArray()->one();
    		
    		if ($userinfo) {

    			$session = \Yii::$app->session;
				$session->set('username_id',$userinfo['id']);  
				$session->set('user',$userinfo['user']);  

    			return $this->redirect(['leave/index']);
    		}else{
    			return $this->render('login', ['model' => $model,]);
    		}
    	}

    }

    

   

}
