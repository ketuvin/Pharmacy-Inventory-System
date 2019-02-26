<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use frontend\models\Records;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-withdraw">
    <div class="body-withdraw">
        <div class="container">
            <div class="row">
                <div class="col-md-8" style="background-color: transparent; padding-left: 25px; width: 200%;">

                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            $form = ActiveForm::begin(['id' => 'voidproduct-form']); 
                            ?>

                            <?= $form ->field($record, 'name')->dropDownList(
                                ArrayHelper::map(Records::find()->all(),'id','name'),
                                ['prompt'=> 'Select Product']
                            );
                            ?>

                            <?= $form->field($record, 'category')->textInput(['id' => 'category','readonly'=> true]);?>

                            <?= $form->field($record, 'manufacturer')->textInput(['id' => 'manufacturer','readonly'=> true]); ?>

                            <?= $form ->field($record, 'quantity')->textInput(['id' => 'stock-available','readonly'=> true])->label('Stock Available');?>

                            <?= $form->field($record, 'unit')->textInput(['id' => 'unit','readonly'=> true]); ?>

                            <?= $form->field($record, 'unit_price')->textInput(['id' => 'unit_price','readonly'=> true]); ?>

                            <?= $form->field($record1, 'remarks')->textarea(['rows'=>'3']);?>

                            <div class="form-group">
                                <div class="col-lg-2" style="margin-right: 10px;">
                                    <span><?= Html::submitbutton('Confirm', ['class'=>'btn btn-primary']);?></span>
                                </div>
                            </div>
                            
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$script = <<< JS

$('#records-name').change(function(){
   var id = $(this).val();
   $.get('/voided/get-product-details', { id : id }, function(data){
       var data = $.parseJSON(data);

       $('#category').attr('value', data.category);
       $('#manufacturer').attr('value', data.manufacturer);
       $('#stock-available').attr('value', data.quantity);
       $('#unit').attr('value', data.unit);
       $('#unit_price').attr('value', data.unit_price);
   });
});

JS;
$this->registerJs($script);
?>