<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Username */
/* @var $form ActiveForm */
?>
<div class="username-login">

    <?php $form = ActiveForm::begin(['action' => ['username/login'], 'method' => 'post',]); ?>

        <?= $form->field($model, 'user') ?>
        <?= $form->field($model, 'pwd') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- username-login -->
