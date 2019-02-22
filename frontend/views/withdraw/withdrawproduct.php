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
                            $form = ActiveForm::begin(['id' => 'withdrawproduct-form']); 
                            ?>
                            <?= $form->field($record1, 'remarks');?>

                            <?= $form ->field($record, 'name')->dropDownList(
                                ArrayHelper::map(Records::find()->all(),'id','name'),
                                ['prompt'=> 'Select Product']
                            );
                            ?>

                            <?= $form ->field($record, 'quantity')->textInput(['id' => 'stock-available','readonly'=> true])->label('Stock Available');?>

                            <?= $form->field($record, 're_stock');?>

                            <div class="form-group">
                                <div class="col-lg-2" style="margin-right: 10px;">
                                    <span><?= Html::submitbutton('Withdraw', ['class'=>'btn btn-primary']);?></span>
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
   $.get('/pharmacy/get-stock-available', { id : id }, function(data){
       var data = $.parseJSON(data);

       $('#stock-available').attr('value', data.quantity);
   });
});

JS;
$this->registerJs($script);
?>