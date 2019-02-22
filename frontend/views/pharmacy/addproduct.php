<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Units;
use frontend\models\Category;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-create">

    <div class="body-create">
         <div class="row">
            <div class="col-lg-6">
                <?php $form = ActiveForm::begin(['id' => 'addproduct-form']); ?>

                    <?= $form->field($record1, 'category')->dropDownList(
                        ArrayHelper::map(Category::find()->all(),'categ_id','category'),
                        ['prompt'=> 'Select Category']
                    ) ?>

                    <?= $form->field($record, 'name') ?>

                    <?= $form->field($record, 'manufacturer') ?>

                    <p style="color: #4d4d4d;">If the unit you want to use is not in the list of options, please click Unit button to add new unit. After saving the new unit, click on Medicines tab.</p>
                    <?= Html::a('Unit', ['/unit/unit'], ['class' => 'btn btn-primary', 'style' => 'float: right; display: inline-block; margin-bottom: 5px;']) ?>

                    <?= $form->field($record2, 'unit_name')->dropDownList(
                        ArrayHelper::map(Units::find()->all(),'unit_id','unit_name'),
                        ['prompt'=> 'Select Unit']
                    ) ?>

                    <?= $form->field($record, 'unit_price') ?>

                    <?= $form->field($record, 'quantity') ?>

                    <div class="form-group">
                        <div class="col-lg-3">
                            <span><?= Html::submitbutton('Add Product', ['class'=>'btn btn-primary']) ?></span>
                        </div>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
