<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-update">
   
    <div class="body-update">
         <div class="row">
            <div class="col-lg-6">
                <?php
                    $form = ActiveForm::begin(['id' => 'update-form']); 
                ?>

                <?php $items = ['Liquid'=>'Liquid','Tablet'=>'Tablet', 'Capsules'=>'Capsules', 'Topical'=>'Topical', 'Suppositories'=>'Suppositories', 'Drops'=>'Drops', 'Inhalers'=>'Inhalers', 'Injections'=>'Injections'];?>
                <?= $form ->field($record, 'Category')->dropDownList($items, ['prompt' => 'Select']);?>

                <?= $form ->field($record, 'Name');?>

                <?= $form ->field($record, 'Manufacturer');?>

                <?= $form ->field($record, 'Unit_price');?>

                <div class="form-group">
                    <div class="col-lg-2">
                        <span><?= Html::submitbutton('Save', ['class'=>'btn btn-primary']);?></span>
                    </div>
                    <div class="col-lg-2">
                        <span><?= Html::a('Cancel', ['/pharmacy/home'], ['class' => 'btn btn-primary'])?></span>
                    </div>
                </div>
                
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
