<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\grid\GridView;
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
                            <h1 style="margin-bottom: 10px;">Units</h1>
                            <span style="margin-bottom: 20px;"><?= Html::button('Add Unit', ['value' => Url::to(['/unit/addunit']), 'class' => 'btn btn-success', 'id' => 'modalButtonUnit'])?></span>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">ADD UNIT</h3>',
                                    'id' => 'modalUnit',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='addUnit'></div>";
                                
                                Modal::end();
                            ?>
                        </div>

                        <div class="row" style="margin-top: 30px;">
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">EDIT UNIT</h3>',
                                    'id' => 'modalEditUnit',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='editUnit'></div>";

                                Modal::end();
                            ?>
                            <?php Pjax::begin(['id'=>'unitID']); ?>
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                                'columns' => [
                                    [
                                        'attribute' => 'unit_name',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            return Html::a($model->unit_name, ['/unit/editunit', 'unit_name' => $model->unit_name], ['class' => 'modalButtonEditUnit', 'target'=>'_blank', 'data-toggle'=>'tooltip', 'title'=>'Update Unit']);
                                         }
                                    ],
                                ],
                            ]); ?>
                            <?php Pjax::end(); ?>
                            <?php $this->registerJs(
                                '
                                init_click_handlers();
                                $("#unitID").on("pjax:success", function() {
                                  init_click_handlers();
                                });'
                            ); ?>
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