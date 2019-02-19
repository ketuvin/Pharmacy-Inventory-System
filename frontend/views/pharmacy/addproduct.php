<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Units;
use app\models\Category;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-create">

    <div class="body-create">
         <div class="row">
            <div class="col-lg-6">
                <?php $form = ActiveForm::begin(['id' => 'addproduct-form']); ?>

                    <?= $form->field($record1, 'Category')->dropDownList(
                        ArrayHelper::map(Category::find()->all(),'categID','Category'),
                        ['prompt'=> 'Select Category']
                    ) ?>

                    <?= $form->field($record, 'Name') ?>

                    <?= $form->field($record, 'Manufacturer') ?>

                    <p style="color: #4d4d4d;">If the unit you want to use is not in the list of options, please click Unit button to add new unit. After saving the new unit, click on Medicines tab.</p>
                    <?= Html::a('Unit', ['/pharmacy/unit'], ['class' => 'btn btn-primary', 'style' => 'float: right; display: inline-block; margin-bottom: 5px;']) ?>

                    <?= $form->field($record2, 'Unit_name')->dropDownList(
                        ArrayHelper::map(Units::find()->all(),'unitID','Unit_name'),
                        ['prompt'=> 'Select Unit']
                    ) ?>

                    <?= $form->field($record, 'Unit_price') ?>

                    <?= $form->field($record, 'Quantity') ?>

                    <div class="form-group">
                        <div class="col-lg-3">
                            <span><?= Html::submitbutton('Add Product', ['class'=>'btn btn-primary']) ?></span>
                        </div>
                        <div class="col-lg-2">
                            <span><?= Html::a('Back', ['/pharmacy/home'], ['class' => 'btn btn-primary']) ?></span>
                        </div>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
