<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use kartik\icons\Icon;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-unit">
    <div class="body-unit">
        <div class="container">
            <div class="row" id="medicine-home">
                <div class="col-md-8">
                    <div class="unit-container">
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
                            <h1 style="margin-bottom: 10px;">Reports</h1>
                            <span style="margin-bottom: 20px;"><?= Html::button('Status Report', ['value' => Url::to(['/reports/statusreport']), 'class' => 'btn btn-success', 'id' => 'modalButtonReport'])?></span>
                            <span style="margin-bottom: 20px;"><?= Html::button('Withdrawal Report', ['value' => Url::to(['/reports/withdrawalsreport']), 'class' => 'btn btn-success', 'id' => 'modalButtonWithdrawReport'])?></span>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">STATUS REPORT</h3>',
                                    'id' => 'modalReport',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='createReport'></div>";
                                
                                Modal::end();
                            ?>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">WITHDRAWAL REPORT</h3>',
                                    'id' => 'modalWithdrawReport',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='createWithdrawalReport'></div>";
                                
                                Modal::end();
                            ?>
                        </div>
                        <div class="row" style="margin-top: 30px;">
                            <?php
                                echo Tabs::widget([
                                    'encodeLabels' => false,
                                    'items' => [
                                        [
                                            'label' => Icon::show('tag'). 'Status Report',
                                            'content' => $this->render('_reports', ['dataProvider' => $dataProvider]),
                                            'active' => true
                                        ],
                                        [
                                            'label' => Icon::show('tags'). 'Withdrawals Report',
                                            'content' => $this->render('_reports1', ['dataProvider1' => $dataProvider1]),
                                            'headerOptions' => [],
                                            'options' => ['id' => 'myveryownID'],
                                        ],
                                    ],
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>