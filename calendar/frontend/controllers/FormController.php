<?php

namespace frontend\controllers;
use yii;
use yii\web\Controller;
use yii\helpers\Url;
use frontend\models\Reg;
use frontend\models\Filed;


class FormController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReg(){
    	$model = new Filed;
    	$data = Filed::find()->asArray()->all();

    	return $this->render('reg', ['model' => $model, 'data' => $data]);

    }

    public function actionAdd(){
    	$data = Yii::$app->request->post();

    	$reg = new Reg;
    	$reg->user = $data['user'];
    	$reg->pwd = $data['pwd'];
    	$reg->desc = $data['desc'];
    	$reg->save();

    }

    public function actionSign(){
    	
    	return $this->render('sign');
    }

}
