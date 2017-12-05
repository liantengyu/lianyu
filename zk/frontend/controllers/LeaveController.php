<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Leave;
use frontend\models\Username;
use yii\data\Pagination;
use DfaFilter\SensitiveHelper;

class LeaveController extends Controller
{
    public function actionIndex()
    {
    	$model = new Leave();
    	$data = Leave::find()->innerJoin('username', 'leave.username_id = username.id');
    	$pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '5']);  
      	$model = $data->offset($pages->offset)->limit($pages->limit)->asArray()->all(); //分页 

        return $this->render('index',[  
             'model' => $model,  
             'pages' => $pages,  
       ]);
    }

    public function actionAdd()
    {
    	$model = new Leave();


    	$data = Yii::$app->request->post();

        // 获取感词库索引数组
        $wordData = array(
            '察象蚂',
            '拆迁灭',
            '车牌隐',
            '成人电',
            '成人卡通',
        );

        // 敏感词替换为***为例
        $data['content'] = SensitiveHelper::init()->setTree($wordData)->replace($data['content'], '***');

    	$model->username_id = $data['username_id'];
    	$model->content = $data['content'];
    	$model->user = $data['user'];
    	$model->time = date('Y-m-d H:i:s');
    	$model->save();

        return $this->redirect(['leave/index']);

    }

    public function actionUpdate()
    {
    	$id = Yii::$app->request->get('id');
    	
    	$data = Leave::find()->where(['id' => $id])->asArray()->one();

        return $this->render('update',['data' => $data]);

    }

    public function actionDel(){
    	$id = Yii::$app->request->get('id');
    	
    	$username = leave::find()->where(['id' => $id])->one();
    	$res = $username->delete();
    	if ($res) {

    		return $this->redirect(['leave/index']);
    	}
    }

    public function actionUpdatedo()
    {
    	// $model = new Leave();


    	$data = Yii::$app->request->post();
    	$model = Leave::find()->where(['id' => $data['id']])->one();
    	$model->username_id = $data['username_id'];
    	$model->content = $data['content'];
    	$model->time = date('Y-m-d H:i:s');
    	$model->save();

        return $this->redirect(['leave/index']);

    }

}
