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
$user = $session->get('user');
?>

	<div class="leave-index">
	

	<?=Html::beginForm(Url::to(['leave/add']),'post');?>
		<?=Html::textarea('content','',['class'=>'form-control','row'=>'3']);?>
		<?=Html::input('hidden','username_id',"$username_id",['class'=>'form-control']);?>
		<?=Html::input('hidden','user',"$user",['class'=>'form-control']);?>
		<?=Html::submitButton('提交',['class'=>'btn btn-primary']);?>
	<?=Html::endForm()?>
	
	<table border="1" width="500px">
		<body>
			<tr>
				<th>序号</th>
				<th>用户</th>
				<th>发表内容</th>
				<th>操作</th>
			</tr>
			<?php foreach ($model as $key => $val): ?>
				<tr>
					<td><?=$val['id'] ?></td>
					<td><?=$val['user'] ?></td>
					<td><?=$val['content'] ?></td>
					<td>
						<a href="<?= Url::toRoute(['leave/del','id'=>$val['id']]);?>">删除</a>
            			<a href="<?= Url::toRoute(['leave/update','id'=>$val['id']]);?>">修改</a>
            		</td>
				</tr>
			<?php endforeach ?>
		</body>
	</table>
<?php  
  echo LinkPager::widget([  
      'pagination' => $pages,  
  ]);  
?>  
	</div> <!-- username-index -->


