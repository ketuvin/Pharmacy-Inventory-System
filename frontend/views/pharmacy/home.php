<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\sidenav\SideNav;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\icons\Icon;
use yii\widgets\Pjax;
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
                        <?php Pjax::begin(); ?>
                        <div class="row" style="margin-top: 30px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                    <th scope="col" style="width: 10%;">Category</th>
                                    <th scope="col" style="width: 40%;">Category Description</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Manufacturer</th>
                                    <th scope="col" style="width: 11%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($records) > 0): ?>
                                        <?php foreach($records as $record): ?>
                                        <tr class="table-active">
                                            <th scope="row"><?php echo $record->Category; ?></th>
                                            <td>
                                            <?php 
                                            foreach($category as $categ):
                                                if($record->Category==$categ->Category){
                                                    echo $categ->Description;
                                                }
                                            endforeach;   
                                            ?>
                                            </td>
                                            <td><?php echo $record->Name; ?></td>
                                            <td><?php echo $record->Manufacturer; ?></td>
                                            <td>
                                                <span><?= Html::button(Icon::show('eye-open'), ['value' => Url::to(['pharmacy/view', 'ID' => $record->ID, 'Category' => $record->Category]), 'class' => 'label label-primary modalButtonViewProduct']) ?></span>
                                                <span><?= Html::button(Icon::show('edit'), ['value' => Url::to(['pharmacy/update', 'ID' => $record->ID]), 'class' => 'label label-default modalButtonUpdateProduct']) ?></span>
                                                <span><?= Html::button(Icon::show('plus'), ['value' => Url::to(['pharmacy/addstock', 'ID' => $record->ID]), 'class' => 'label label-success modalButtonStock']) ?></span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td>No Records Found!</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>           
                            <div style="text-align: center;">
                                <?php echo LinkPager::widget(['pagination' => $pages,]);?>
                            </div>
                        </div>
                        <?php Pjax::end(); ?>
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