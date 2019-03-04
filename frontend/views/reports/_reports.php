<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;

Pjax::begin(['id'=>'reportID']);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
        'columns' => [
            'report_no',
            [
                'attribute' => 'generic_name',
                'value' => function ($model) {
                    if(sizeof($model->generic_name) > 1) {
                        $generic_name = '';
                        foreach ($model->generic_name as $key => $value) {
                            if(sizeof($model->generic_name)-1 == $key) {
                                $generic_name .= $value;
                            }else {
                                $generic_name .= $value . ', ';
                            }
                        }

                        return $generic_name;
                    }
                    else
                    {
                        return $model->generic_name[0];
                    }
                },
                'contentOptions' => ['id' => 'name-text-wrap'],
            ],
            'remarks',
            'created_date',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{export} {delete}',
                'header' => 'Actions',
                'buttons' => [
                'export' => function ($url, $model) {
                    return Html::a('Export', ['/reports/generate-report', 'generic_name' => $model->generic_name], ['class' => 'btn btn-primary', 'target'=>'_blank', 'data-toggle'=>'tooltip', 'title'=>'Will open the generated PDF file in a new window', 'data-pjax' => 0]);
                    },
                'delete' => function ($url, $model) {
                    return Html::a('Delete', ['reports/deletereport', 'report_no' => $model->report_no], ['data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),'data-method'  => 'post', 'class' => 'btn btn-danger']);
                    },
                ],
            ],
        ],
    ]);
    Pjax::end();
    $this->registerJs(
        '
        init_click_handlers();
        $("#reportID").on("pjax:success", function() {
          init_click_handlers();
        });'
    );

?>