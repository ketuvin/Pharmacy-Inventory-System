<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker

/* @var $this yii\web\View */
/* @var $model frontend\models\Reports */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reports-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
	    echo '<label class="control-label">Select date range</label>';
		echo DatePicker::widget([
		    'model' => $model,
		    'attribute' => 'start_date',
		    'attribute2' => 'end_date',
		    'options' => ['placeholder' => 'Start date'],
		    'options2' => ['placeholder' => 'End date'],
		    'type' => DatePicker::TYPE_RANGE,
		    'form' => $form,
		    'pluginOptions' => [
		        'format' => 'MM dd, yyyy',
		        'autoclose' => true,
		    ]
		]);
	?>

    <?= $form ->field($model, 'remarks');?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>