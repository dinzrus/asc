<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\MunicipalityCity */

?>
<div class="municipality-city-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->municipality_city) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'municipality_city',
        [
            'attribute' => 'province.province',
            'label' => 'Province',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>