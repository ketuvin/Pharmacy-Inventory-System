<?php
use yii\helpers\Html;
use kartik\sidenav\SideNav;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\icons\Icon;
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
                            <span><?= Html::a('Deposit', ['/pharmacy/deposit'], ['class' => 'btn btn-success'])?></span>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">ADD PRODUCT</h3>',
                                    'id' => 'modal',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='modalContent'></div>";

                                Modal::end();
                            ?>

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

                        </div>
                        <div class="row" style="margin-top: 30px;">
                            <?php Pjax::begin(); ?>
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                                'columns' => [
                                    'Category',
                                    'Name',
                                    'Manufacturer',
                                    'Unit_price',
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'contentOptions' => ['style' => 'text-align:center;'],
                                        'headerOptions' => ['style' => 'text-align:center;'],
                                        'template' => '{view} {update} {addstock}',
                                        'header' => 'Actions',
                                        'buttons' => [
                                        'view' => function ($url,$model) {
                                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/pharmacy/view', 'ID' => $model->ID, 'Category' => $model->Category], ['class' => 'modalButtonViewProduct']);
                                            },
                                        'update' => function ($url, $model) {
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/pharmacy/update', 'ID' => $model->ID], ['class' => 'modalButtonUpdateProduct']);
                                            },
                                        'addstock' => function ($url, $model) {
                                            return Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/pharmacy/addstock', 'ID' => $model->ID], ['class' => 'modalButtonStock']);
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