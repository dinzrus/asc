<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Emposition */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-solid">
    <div class="box-body">
        <div class="emposition-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->errorSummary($model); ?>

            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?=
            $form->field($model, 'employee_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map($employee, 'id', 'fullname'),
                'options' => ['placeholder' => 'Choose Employee'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'branch_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Branch::find()->orderBy('branch_id')->asArray()->all(), 'branch_id', 'branch_description'),
                'options' => ['placeholder' => 'Choose Position'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <?=
            $form->field($model, 'position_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Position::find()->orderBy('id')->asArray()->all(), 'id', 'position'),
                'options' => ['placeholder' => 'Choose Position'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

<?php ActiveForm::end(); ?>

        </div>
    </div>
</div>