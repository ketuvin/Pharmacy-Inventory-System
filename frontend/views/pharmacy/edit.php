<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-category">

    <div class="body-category">
        <div class="row">
            <div class="col-lg-6">
                <?php
                    $form = ActiveForm::begin(['id' => 'edit-form']); 
                ?>

                <?= $form ->field($category, 'Category');?>

                <?= $form ->field($category, 'Description')->textarea(['rows' => '5']);?>

                <div class="form-group">
                    <div class="col-lg-2">
                        <span><?= Html::submitbutton('Save', ['class'=>'btn btn-primary']);?></span>
                    </div>
                    <div class="col-lg-2">
                        <span><?= Html::a('Cancel', ['/pharmacy/category'], ['class' => 'btn btn-primary'])?></span>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>