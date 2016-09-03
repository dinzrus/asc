<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoanType */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Loan',
        'relID' => 'loan',
        'value' => \yii\helpers\Json::encode($model->loans),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="loan-type-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->errorSummary($model); ?>

            <?= $form->field($model, 'loan_id')->textInput(['placeholder' => 'Loan']) ?>

            <?= $form->field($model, 'loan_description')->textInput(['maxlength' => true, 'placeholder' => 'Loan Description']) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
