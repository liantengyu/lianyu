<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager; 

/* @var $this yii\web\View */
/* @var $model frontend\models\Username */
/* @var $form ActiveForm */

$session = \Yii::$app->session;
$username_id = $session->get('username_id');
$content = $data['content'];
$id = $data['id'];
?>

	<div class="leave-index">
	

	<?=Html::beginForm(Url::to(['leave/updatedo']),'post');?>
		<?=Html::textarea('content',"$content",['class'=>'form-control','row'=>'3']);?>
		<?=Html::input('hidden','username_id',"$username_id",['class'=>'form-control']);?>
		<?=Html::input('hidden','id',"$id",['class'=>'form-control']);?>
		<?=Html::submitButton('提交',['class'=>'btn btn-primary']);?>
	<?=Html::endForm()?>
	
	
	</div> <!-- username-index -->


