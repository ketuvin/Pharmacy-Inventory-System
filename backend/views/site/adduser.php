<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-admin">
    <div class="body-admin">
        <div class="container">
            <div class="row">
                <div class="col-md-8" style="background-color: transparent;">
                    <div class="admin-container" style="padding-left: 7%;">
                        <div class="row" style="margin-top: 30px;">
                         <div class="col-lg-5">
                            <?php $form = ActiveForm::begin(['id' => 'form-adduser']); ?>

                            <?= $form->field($model, 'fullname')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'email') ?>

                            <?= '<label class="control-label">Gender</label>' ?>
                            <?= $form->field($model, 'gender')->radio(['label' => 'Male', 'value' => 'Male', 'unchecked' => null]) ?>
                            <?= $form->field($model, 'gender')->radio(['label' => 'Female', 'value' => 'Female', 'unchecked' => null]) ?>

                            <?= $form->field($model, 'address')->textarea(['rows'=>'6']); ?>

                            <div class="form-group">
                                <?= Html::submitButton('Add User', ['class' => 'btn btn-primary', 'name' => 'signup-button'])?>
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