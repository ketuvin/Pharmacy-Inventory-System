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
                        <?php if(Yii::$app->session->hasFlash('message')): ?>
                            <div class="alert alert-dismissible alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::$app->session->getFlash('message');?>
                            </div>
                        <?php endif;?>
                        <?php if(Yii::$app->session->hasFlash('success')): ?>
                            <div class="alert alert-dismissible alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::$app->session->getFlash('success');?>
                            </div>
                        <?php endif;?>
                        <?php if(Yii::$app->session->hasFlash('error')): ?>
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::$app->session->getFlash('error');?>
                            </div>
                        <?php endif;?>
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">Withdrawals</h1>
                            <span><?= Html::button('Withdraw', ['value' => Url::to(['/withdraw/withdrawproduct']), 'class' => 'btn btn-success', 'id' => 'modalButtonWithdraw'])?></span>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">WITHDRAW</h3>',
                                    'id' => 'modalWithdraw',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='contentWithdraw'></div>";
                                
                                Modal::end();
                            ?>
                        </div>
                        <div class="row" style="margin-top: 30px;">
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
                                        return Html::a($model->pull_outno, ['/withdraw/viewwithdraw', 'pull_outno' => $model->pull_outno], ['class' => 'modalButtonView', 'target'=>'_blank', 'data-toggle'=>'tooltip', 'title'=>'Show Withdrawal Details']);
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