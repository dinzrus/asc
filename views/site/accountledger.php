<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\BorrowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Borrowers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-body">  
        <?=
        GridView::widget([
            'dataProvider' => $borrowers,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'last_name',
                'first_name',
                'middle_name',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{ledger}',
                    'buttons' => [
                        'ledger' => function ($url, $model) {
                            return Html::a(
                                            '<span class="fa fa-eye"></span> View Ledger', $url, [
                                        'title' => Yii::t('app', 'View Ledger'),
                                        'class' => 'btn btn-primary btn-xs',]
                            );
                        },
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'ledger') {
                                $url = '/site/ledger?id=' . $model->id;
                                return $url;
                            }
                        }
                    ]
                ],
            ]
        ])
        ?>
    </div>
</div>



