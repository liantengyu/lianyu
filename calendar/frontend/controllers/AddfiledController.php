<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use frontend\models\Filed;

class AddfiledController extends Controller
{
	public $layout = false;
    public function actionIndex()
    {

        return $this->render('index');
    }


    // 添加字段
    public function actionAdd()
    {
    	
    	if ($_GET) {
    		$id = Yii::$app->request->get('id');
    		$data = Filed::find()->where(['id' => $id])->asArray()->one();

			return $this->render('add',['data' => $data]);
    	}else{
    		return $this->render('add');
    	}

        
    }

    public function actionAdd_edit(){
		$data = Yii::$app->request->post();

    	if (Yii::$app->request->post('filed_id')) {
    		
    		$filed = Filed::find()->where(['id' => $data['filed_id']])->one();
    		
    	}else{

    		$filed = new Filed;
	    	
    	}

		$filed->name = $data['name'];
    	$filed->default = $data['default'];
    	$filed->cat = $data['cat'];
    	$filed->rule = $data['rule'];
    	if (isset($data['is_must'])) $filed->is_must = $data['is_must'];
    	$filed->min = $data['min'];
    	$filed->max = $data['max'];
    	$filed->save();
    	
    	return $this->redirect(['addfiled/list']);
    }

    public function actionList(){
    	$filed = new Filed;
    	$data = $filed->find()->asArray()->all();
    	return $this->render('list',['data' => $data]);
    }

    public function actionDel(){
    	
    	$id = Yii::$app->request->get('id');
    	$filed = Filed::find()->where(['id' => $id])->one();
    	$res = $filed->delete();
    	if ($res) return $this->redirect(['list']);
    }

}
