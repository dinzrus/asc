<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Borrower */

$this->title = 'Save As New Borrower: '. ' ' . $model->borrower_id;
$this->params['breadcrumbs'][] = ['label' => 'Borrower', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->borrower_id, 'url' => ['view', 'id' => $model->borrower_id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="borrower-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
