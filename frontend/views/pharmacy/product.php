<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-home">
    <div class="body-home">
        <div class="container">
            <div class="row" id="medicine-home">
                <div class="col-md-8">
                    <div class="home-container">
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
                            <h1 style="margin-bottom: 10px;">Medicines</h1>
                            <span style="margin-bottom: 20px;"><?= Html::button('Add Product', ['value' => Url::to(['/pharmacy/addproduct']), 'class' => 'btn btn-success', 'id' => 'modalButton'])?></span>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">ADD PRODUCT</h3>',
                                    'id' => 'modal',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='modalContent'></div>";

                                Modal::end();
                            ?>
                        </div>
                        <div class="row" style="margin-top: 30px;">
                            <?php Pjax::begin(); ?>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">ADD STOCK</h3>',
                                    'id' => 'modalStock',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='addStock'></div>";

                                Modal::end();
                            ?>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">VIEW PRODUCT</h3>',
                                    'id' => 'modalViewProduct',
                                    'size' => 'modal-lg',
                                ]);

                                echo "<div id='viewProduct'></div>";

                                Modal::end();
                            ?>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">UPDATE PRODUCT</h3>',
                                    'id' => 'modalUpdateProduct',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='updateProduct'></div>";

                                Modal::end();
                            ?>
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                                'columns' => [
                                    'category',
                                    'name',
                                    'manufacturer',
                                    'unit_price',
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'contentOptions' => ['style' => 'text-align:center;'],
                                        'headerOptions' => ['style' => 'text-align:center;'],
                                        'template' => '{viewproduct} {updateproduct} {addstock}',
                                        'header' => 'Actions',
                                        'buttons' => [
                                        'viewproduct' => function ($url,$model) {
                                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/pharmacy/viewproduct', 'id' => $model->id, 'category' => $model->category], ['class' => 'modalButtonViewProduct']);
                                            },
                                        'updateproduct' => function ($url, $model) {
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/pharmacy/updateproduct', 'id' => $model->id], ['class' => 'modalButtonUpdateProduct']);
                                            },
                                        'addstock' => function ($url, $model) {
                                            return Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/pharmacy/addstock', 'id' => $model->id], ['class' => 'modalButtonStock']);
                                            },
                                        ],
                                    ],
                                ],
                            ]); ?>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>