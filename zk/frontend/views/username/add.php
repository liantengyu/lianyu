<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Username */
/* @var $form ActiveForm */
?>
<div class="username-add">

    <?php $form = ActiveForm::beginForm(['action' => ['username/add'], 'method' => 'post',]); ?>

        <?= $form->field($model, 'user') ?>
        <?= $form->field($model, 'pwd')->passwordInput() ?>
        
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::endForm(); ?>

</div><!-- username-add -->
