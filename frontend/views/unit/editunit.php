<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-category">

    <div class="body-category">
        <div class="row">
            <div class="col-lg-6">
                <?php
                    $form = ActiveForm::begin(['id' => 'editunit-form']); 
                ?>

                <?= $form ->field($unit, 'unit_name');?>

                <div class="form-group">
                    <div class="col-lg-2">
                        <span><?= Html::submitbutton('Save', ['class'=>'btn btn-primary']);?></span>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>