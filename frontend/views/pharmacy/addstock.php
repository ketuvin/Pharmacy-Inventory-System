<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-addStock">
   
    <div class="body-addStock">
         <div class="row">
            <div class="col-lg-6">
                <?php
                    $form = ActiveForm::begin(['id' => 'addstock-form']); 
                ?>

                <?= $form ->field($record, 'name');?>

                <?= $form ->field($record, 'quantity')->textInput(['readonly' => true])->label('Stock Available');?>

                <?= $form->field($record, 're_stock');?>

                <div class="form-group">
                    <div class="col-lg-2">
                        <span><?= Html::submitbutton('Add Stock', ['class'=>'btn btn-primary']);?></span>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
