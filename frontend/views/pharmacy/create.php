<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Units;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-create">

    <h1>ADD PRODUCT</h1>
   
    <div class="body-create">
        <?php
            $form = ActiveForm::begin(); 
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
                    <p>If the unit you want to use is not in the list of options, please click Unit button to add new unit. After saving the new unit, click on Medicines tab.</p>
                    <?= Html::a('Unit', ['/pharmacy/addunit'], ['class' => 'btn btn-primary', 'style' => 'float: right; display: inline-block; margin-bottom: 5px;'])?>
                    <?= $form ->field($record2, 'unitID')->dropDownList(
                        ArrayHelper::map(Units::find()->all(),'unitID','Unit_name'),
                        ['prompt'=> 'Select Unit']
                    );?>
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
                        <span><?= Html::submitbutton('Add Product', ['class'=>'btn btn-primary']);?></span>
                    </div>
                    <div class="col-lg-2" style="padding-left: 5px;">
                        <span><?= Html::a('Back', ['/pharmacy/home'], ['class' => 'btn btn-primary'])?></span>
                    </div>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
