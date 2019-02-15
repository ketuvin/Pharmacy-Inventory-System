<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-addStock">
   
    <div class="body-addStock">
        <?php
            $form = ActiveForm::begin(); 
        ?>
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
                    <?= $form->field($record, 'Quantity');?>
                </div>
            </div>
        </div>

         <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <div class="col-lg-2">
                        <span><?= Html::submitbutton('Add Stock', ['class'=>'btn btn-primary']);?></span>
                    </div>
                    <div class="col-lg-2" style="padding-left: 20px;">
                        <span><?= Html::a('Cancel', ['/pharmacy/home'], ['class' => 'btn btn-primary'])?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
