<?php

namespace frontend\controllers;

use yii;
use yii\web\Controller;
use frontend\Models;
use frontend\models\Zkuserinfo;
use frontend\models\ZkTag;





class ZkuserinfoController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionReg1(){
    	
    	if (!$_POST) {

    		$id = yii::$app->request->get('id');
    		if ($id) {

    			$data = Zkuserinfo::find()->where(['id' => $id])->asArray()->one();
    			return $this->render('reg1', ['data' => $data]);

    		}else{
    			return $this->render('reg1');
    		}
    		
    	}else{
    		$userinfo = new Zkuserinfo;
    		$data = yii::$app->request->post();
    		
    		if (!$data['id']) {
    			$userinfo->phone = $data['phone'];
	    		$userinfo->pwd = $data['pwd'];
	    		$userinfo->save();
	    		$id = $userinfo->attributes['id'];

	    		$session = \Yii::$app->session;
				$session->set('id',$id);
    		}

    		return $this->redirect(['reg2']);


    	}

    }


    public function actionReg2(){
    	
    	if (!$_POST) {

    		$id = yii::$app->request->get('id');
    		if ($id) {

    			$data = Zkuserinfo::find()->where(['id' => $id])->asArray()->one();
    			return $this->render('reg2', ['data' => $data]);

    		}else{
    			return $this->render('reg2');
    		}

    	}else{
    		
    		$data = yii::$app->request->post();

    		if (!$data['id']) {
    			$userinfo = Zkuserinfo::find()->where(['id' => $data['id']])->one();
	    		$userinfo->name = $data['name'];
	    		$userinfo->birth = $data['birth'];
	    		$userinfo->address = $data['address'];
	    		$userinfo->save();
    		}

    		return $this->redirect(['reg3']);


    	}

    }


    public function actionReg3(){
    	if (!$_POST) {

    		$userinfo = ZkTag::find()->asArray()->all();


    		return $this->render('reg3',['data' => $userinfo]);
    	}else{
    		
    		$data = yii::$app->request->post();
    		
    		for ($i=0; $i <count($data['name']) ; $i++) { 
    				if ($data['name'][$i] == '') {
    					unset($data['name'][$i]);
    				}
    			}	
    		$data['name'] = implode(',', $data['name']);
    		$userinfo = Zkuserinfo::find()->where(['id' => 1])->one();
    		$userinfo->tag = $data['name'];
    		$userinfo->save();

    		echo '添加成功';die;	


    	}
    }
}
