<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Username */
/* @var $form ActiveForm */
$user_id = $userinfo['id'];
?>

<div class="username-index">
	

	<?=Html::beginForm(Url::to(['username/index']),'post');?>
		<?=Html::textarea('content','',['class'=>'form-control','row'=>'3']);?>
		<?=Html::input('text','user_id',"$user_id",['class'=>'form-control']);?>
		<?=Html::submitButton('提交',['class'=>'btn btn-primary']);?>
	<?=Html::endForm()?>
	
	

</div> <!-- username-index -->
