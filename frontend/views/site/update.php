<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'YII2 CRUD Application';
?>
<div class="site-update">

    <h1>UPDATE PRODUCT</h1>
   
    <div class="body-update">
        <?php
            $form = ActiveForm::begin(); 
        ?>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form ->field($record, 'ID');?>
                </div>
            </div>
        </div>

         <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?php $items = ['Liquid'=>'Liquid','Tablet'=>'Tablet', 'Capsules'=>'Capsules', 'Topical'=>'Topical', 'Suppositories'=>'Suppositories', 'Drops'=>'Drops', 'Inhalers'=>'Inhalers', 'Injections'=>'Injections'];?>
                    <?= $form ->field($record, 'Category')->dropDownList($items, ['prompt' => 'Select']);?>
                </div>
            </div>
        </div>

         <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form ->field($record, 'Name');?>
                </div>
            </div>
        </div>

         <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form ->field($record, 'Brand');?>
                </div>
            </div>
        </div>
        
         <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($record, 'Quantity');?>
                </div>
            </div>
        </div>

         <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <div class="col-lg-3">
                        <span><?= Html::submitbutton('Update Product', ['class'=>'btn btn-primary']);?></span>
                    </div>
                    <div class="col-lg-2" style="padding-left: 20px;">
                        <span><?= Html::a('Back', ['/site/home'], ['class' => 'btn btn-primary'])?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
