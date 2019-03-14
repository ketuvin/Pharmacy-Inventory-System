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
                            <h1 style="margin-bottom: 10px;">Voided Products</h1>
                            <span><?= Html::button('Void Product', ['value' => Url::to(['/voided/voidproduct']), 'class' => 'btn btn-success', 'id' => 'modalButtonVoid'])?></span>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">VOID PRODUCT</h3>',
                                    'id' => 'modalVoid',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='contentVoid'></div>";
                                
                                Modal::end();
                            ?>
                        </div>
                        <div class="row" style="margin-top: 30px;">
                        <?php
                            Modal::begin([
                                'header' => '<h3 style="text-align:center;">VOIDED PRODUCT DETAILS</h3>',
                                'id' => 'modalViewVoid',
                                'size' => 'modal-lg',
                            ]);

                            echo "<div id='viewVoidContent'></div>";

                            Modal::end();
                        ?>
                        <?php Pjax::begin(['id'=>'voidID']); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                            'columns' => [
                                [
                                    'attribute' => 'voidno',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return Html::a($model->voidno, ['/voided/viewvoid', 'voidno' => $model->voidno], ['class' => 'modalButtonViewVoid', 'target'=>'_blank', 'data-toggle'=>'tooltip', 'title'=>'Show Voided Product Details']);
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
                            $("#voidID").on("pjax:success", function() {
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