<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Borrower */

$this->title = 'Create Borrower';
$this->params['breadcrumbs'][] = ['label' => 'Borrower', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrower-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
