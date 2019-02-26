<?php
use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use yii\bootstrap\Tabs;
use kartik\icons\Icon;

Icon::map($this);
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-dashboard">
    <div class="body-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="dash-container">
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
                            <h1 style="margin-bottom: 10px;">Overview</h1>
                        </div>
                        <div class="row">
                            <?php
                                echo Tabs::widget([
                                    'encodeLabels' => false,
                                    'items' => [
                                        [
                                            'label' => Icon::show('arrow-down'). 'Least Amount',
                                            'content' => $this->render('_chart1', ['diagram' => $diagram]),
                                            'active' => true
                                        ],
                                        [
                                            'label' => Icon::show('arrow-up'). 'Recently Replenished',
                                            'content' => $this->render('_chart2', [
                                                'diagram1' => $diagram1,
                                                'products' => $products
                                            ]),
                                            'headerOptions' => [],
                                            'options' => ['id' => 'myveryownID'],
                                        ],
                                    ],
                                ]);
                            ?>
                            <p style="color: #4d4d4d; font-size: 15px;"><strong>NOTE:</strong> Refresh site every after change to update graph.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
