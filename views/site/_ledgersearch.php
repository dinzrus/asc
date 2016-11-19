<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BorrowerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-borrower-search">
 
    <?php $form = ActiveForm::begin([
        'action' => ['site/accountledger'],
        'method' => 'get',
        'options' => ['data' => ['pjax' => true]],
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'keyword')->textInput(['maxlength' => true, 'placeholder' => 'keyword']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Load All',['site/accountledger'],['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
