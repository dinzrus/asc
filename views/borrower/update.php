<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $borrower app\models\Borrower */

$this->title = 'Update Borrower: ' . ' ' . $borrower->last_name. ', ' . $borrower->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Borrower', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $borrower->last_name. ', ' . $borrower->first_name, 'url' => ['view', 'id' => $borrower->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borrower-update">

    <?=
    $this->render('_form', [
        'borrower' => $borrower,
        'comaker' => $comaker,
        'dependents' => $dependents,
        'update' => $update,
    ])
    ?>

</div>
