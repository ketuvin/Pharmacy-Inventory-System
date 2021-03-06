<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-withdrawals">
    <div class="body-withdrawals">
        <div class="container">
            <div class="row" id="medicine-home">
                <div class="col-md-8">
                    <div class="withdrawals-container">
                        <div class="row">
                            <h1>Withdrawals</h1>

                            <h4 style="color:red">List of all the withdrawal transactions.</h4>
                        </div>
                        <div class="row">
                        <?php
                            Modal::begin([
                                'header' => '<h3 style="text-align:center;">WITHDRAW DETAILS</h3>',
                                'id' => 'modalView',
                                'size' => 'modal-lg',
                            ]);

                            echo "<div id='viewContent'></div>";

                            Modal::end();
                        ?>
                        <?php Pjax::begin(['id'=>'withdrawalsID']); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                            'columns' => [
                                [
                                    'attribute' => 'pull_outno',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return Html::a($model->pull_outno, ['/site/viewwithdraw', 'pull_outno' => $model->pull_outno], ['class' => 'modalButtonView']);
                                     }
                                ],
                                'sku',
                                'product_name',
                                'brand',
                                'manufacturer',
                                'remarks:ntext',
                                'created_date',
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                        <?php $this->registerJs(
                            '
                            init_click_handlers();
                            $("#withdrawalsID").on("pjax:success", function() {
                              init_click_handlers();
                            });'
                        ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>