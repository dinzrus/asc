<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Exceltest */
/* @var $form ActiveForm */
?>
<div class="site-excelupload">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'excelfile')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-excelupload -->
