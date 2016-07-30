<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Borrower */

$this->title = 'Update Borrower: ' . ' ' .$model->principal_last_name.', '.$model->principal_first_name;;
$this->params['breadcrumbs'][] = ['label' => 'Borrower', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->borrower_id, 'url' => ['view', 'id' => $model->borrower_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borrower-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
