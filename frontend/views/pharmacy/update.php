<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-update">
   
    <div class="body-update">
        <?php
            $form = ActiveForm::begin(['id' => 'update-form']); 
        ?>
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
                    <?= $form ->field($record, 'Manufacturer');?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form ->field($record, 'Unit_price');?>
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
                    <div class="col-lg-2">
                        <span><?= Html::submitbutton('Save', ['class'=>'btn btn-primary']);?></span>
                    </div>
                    <div class="col-lg-2">
                        <span><?= Html::a('Cancel', ['/pharmacy/home'], ['class' => 'btn btn-primary'])?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
