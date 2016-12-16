<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Collectorunit */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="collectorunit-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->errorSummary($model); ?>

            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?=
            $form->field($model, 'collector_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map($collectors, 'emp_id', 'fullname'),
                'options' => ['placeholder' => 'Choose Emposition'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'unit_id')->widget(DepDrop::classname(), [
                'options' => ['id' => Html::getInputId($model, 'unit_id')],
                'type' => DepDrop::TYPE_SELECT2,
                'pluginOptions' => [
                    'depends' => [Html::getInputId($model, 'collector_id')],
                    'placeholder' => 'Select city/municipality',
                    'url' => Url::to(['/collectorunit/getunits'])
                ]
            ]);
            ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

