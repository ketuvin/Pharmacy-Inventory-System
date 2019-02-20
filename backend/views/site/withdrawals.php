<?php
use yii\helpers\Html;
use kartik\sidenav\SideNav;
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
                        <?php Pjax::begin(); ?>
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                                'columns' => [
                                    [
                                        'attribute' => 'Pull_outNo',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            return Html::a($model->Pull_outNo, ['/site/view', 'Pull_outNo' => $model->Pull_outNo], ['class' => 'modalButtonView']);
                                         }
                                    ],
                                    'Remarks:ntext',
                                    'Product_name',
                                    'Created_Date',
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