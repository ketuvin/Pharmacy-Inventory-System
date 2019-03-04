<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
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
                            <h1 style="margin-bottom: 10px;">Category</h1>
                        </div>

                        <div class="row" style="margin-top: 30px;">
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">EDIT CATEGORY</h3>',
                                    'id' => 'modalCategory',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='editCategory'></div>";

                                Modal::end();
                            ?>
                            <?php Pjax::begin(['id'=>'categoryID']); ?>
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                                'columns' => [
                                    [
                                        'attribute' => 'category',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            return Html::a($model->category, ['/category/editcategory', 'category' => $model->category], ['class' => 'modalButtonCategory', 'target'=>'_blank', 'data-toggle'=>'tooltip', 'title'=>'Update Category Details']);
                                         }
                                    ],
                                    [
                                        'attribute' => 'description',
                                        'format' => 'ntext',
                                        'contentOptions' => ['id' => 'desc-text-wrap'],
                                    ],
                                ],
                            ]); ?>
                            <?php Pjax::end(); ?>
                            <?php $this->registerJs(
                            '
                            init_click_handlers();
                            $("#categoryID").on("pjax:success", function() {
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