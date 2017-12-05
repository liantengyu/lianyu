<?php 
		
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
 	<meta charset="UTF-8">
 	<title>Document</title>
</head>
<body>
 	<div class="reg-reg">
 		<?php echo Html::beginForm(['form/add'], 'post'); ?>
	 		<table border="1">

			 	<?php foreach ($data as $key => $v): ?>
			 		
		 			<?php 
			 			switch ($v['cat']) {
			 				case 'input-text':
			 					echo "<tr><td>".$v['name']."</td><td>".Html::textInput($v['default'], '')."</td></tr>";
			 					break;
			 				case 'input-password':
			 					echo "<tr><td>".$v['name']."</td><td>".Html::passwordInput($v['default'], '')."</td></tr>";
			 					break;
			 				case 'textarea':
			 					echo "<tr><td>".$v['name']."</td><td>".Html::textarea($v['default'], '')."</td></tr>";
			 					break;
			 			}
		 		    ?>
			 		
			 	<?php endforeach ?>
				<tr>
					<td colspan="2">
						<?=Html:: submitButton('提交', ['class' => 'btn btn-primary'])?>
					</td>
				</tr>
			</table> 	
	 	<?php echo Html::endForm(); ?>
 	</div>
</body>
</html>