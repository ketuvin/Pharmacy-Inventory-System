<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Records;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reports */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reports-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'generic_name')->widget(Select2::classname(),[
	    'data' => ArrayHelper::map(Records::find()->asArray()->all(),'id', function($model) {
						return $model['sku'].': '.$model['generic_name'].' ('.$model['strength'].')';
					},'category'),
	    'maintainOrder' => true,
	    'toggleAllSettings' => [
	        'selectLabel' => '<i class="fas fa-ok-circle"></i> Tag All',
	        'unselectLabel' => '<i class="fas fa-remove-circle"></i> Untag All',
	        'selectOptions' => ['class' => 'text-success'],
	        'unselectOptions' => ['class' => 'text-danger'],
	    ],
	    'options' => ['placeholder' => 'Select a product', 'multiple' => true],
	    'pluginOptions' => [ 
	        'tags' => true,
	        'maximumInputLength' => 10
	    ],
    ]); ?>

    <?= $form ->field($model, 'remarks');?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>