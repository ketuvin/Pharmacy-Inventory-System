<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;

Pjax::begin(['id'=>'withdrawalsreportID']);
    echo GridView::widget([
        'dataProvider' => $dataProvider1,
        'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
        'columns' => [
            'withdraw_reportno',
            'remarks',
            'created_date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{export} {delete}',
                'header' => 'Actions',
                'buttons' => [
                'export' => function ($url, $model) {
                    return Html::a('Export', ['reports/generate-withdrawals-report', 'start_date' => $model->start_date, 'end_date' => $model->end_date], ['class' => 'btn btn-primary', 'target'=>'_blank', 'data-toggle'=>'tooltip', 'title'=>'Download as PDF','data-pjax' => 0]);
                    },
                'delete' => function ($url, $model) {
                    return Html::a('Delete', ['reports/deletewithdrawreport', 'withdraw_reportno' => $model->withdraw_reportno], ['data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),'data-method'  => 'post', 'class' => 'btn btn-danger']);
                    },
                ],
            ],
        ],
    ]);
    Pjax::end();
    $this->registerJs(
        '
        init_click_handlers();
        $("#withdrawalsreportID").on("pjax:success", function() {
          init_click_handlers();
        });'
    );

?>