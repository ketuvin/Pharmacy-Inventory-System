<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-admin">
    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>

    <div class="body-admin">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="admin-container">
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">Add Users</h1>
                        </div>

                        <div class="row" style="margin-top: 30px;">
                         <div class="col-lg-5">
                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                            <?= $form->field($model, 'fullname')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'email') ?>

                            <?= $form->field($model, 'mobile')->widget(PhoneInput::className(), 
                            ['jsOptions' => ['preferredCountries' => ['ph', 'us', 'sg'],]]); ?>

                            <?= '<label class="control-label">Gender</label>' ?>
                            <?= $form->field($model, 'gender')->radio(['label' => 'Male', 'value' => 'Male', 'unchecked' => null]) ?>
                            <?= $form->field($model, 'gender')->radio(['label' => 'Female', 'value' => 'Female', 'unchecked' => null]) ?>

                            <?php $items = ['Filipino' => 'Filipino', 'Chinese' => 'Chinese', 'American' => 'American']; ?>
                            <?= $form->field($model, 'nationality')->dropDownList($items,['prompt'=>'Select']); ?>

                            <?= $form->field($model, 'address')->textarea(['rows'=>'6']); ?>

                            <div class="form-group">
                                <?= Html::submitButton('Add User', ['class' => 'btn btn-primary', 'name' => 'signup-button'])?>
                                <span style="padding-left: 20px;"><?= Html::a('Cancel', ['/site/viewadmin'], ['class' => 'btn btn-primary'])?></span>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
</div>