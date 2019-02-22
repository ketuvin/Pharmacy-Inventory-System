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
                    <div class="deposits-container">
                        <div class="row">
                            <h1>Deposits</h1>

                            <h4 style="color:red">List of all the deposit transactions.</h4>
                        </div>
                        <div class="row">
                        <?php Pjax::begin(); ?>
                        <?php
                            Modal::begin([
                                'header' => '<h3 style="text-align:center;">DEPOSIT DETAILS</h3>',
                                'id' => 'modalViewDeposit',
                                'size' => 'modal-lg',
                            ]);

                            echo "<div id='viewContentDeposit'></div>";

                            Modal::end();
                        ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                            'columns' => [
                                [
                                    'attribute' => 'depositno',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return Html::a($model->depositno, ['/site/viewdeposits', 'depositno' => $model->depositno], ['class' => 'modalButtonViewDeposit']);
                                     }
                                ],
                                'product_name',
                                'created_date',
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- <script type="text/javascript">
        $(function() {
            var href = window.location.href;
            $('div a').each(function(e,i) {
                if (href.indexOf($(this).attr('href')) >= 0) {
                    $(this).addClass('active');
                }
            });
        });
    </script> -->
</div>