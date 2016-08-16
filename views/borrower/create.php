<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $borrower app\models\Borrower */

$this->title = 'Create Borrower';
$this->params['breadcrumbs'][] = ['label' => 'Borrower', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrower-create">
    <?= $this->render('_form', [
        'borrower' => $borrower,
        'comaker' => $comaker,
        'dependent' => $dependent,
        'update' => $update,
        'borrower_comaker' => $borrower_comaker,
    ]) ?>
</div>
