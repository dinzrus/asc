<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\LoanschemeType */

?>
<div class="loanscheme-type-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->loanscheme_type_id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'loanscheme_type_id',
        'type_description',
        'created_date',
        'updated_date',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>