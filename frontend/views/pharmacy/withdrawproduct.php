<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use kartik\sidenav\SideNav;
use yii\widgets\ActiveForm;
use app\models\Records;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-withdraw">
    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>

    <div class="body-withdraw">
        <div class="container">
            <div class="row">
                <div class="col-md-8" style="background-color: transparent; padding-left: 25px; width: 200%;">
                    <?php
                    $form = ActiveForm::begin(); 
                    ?>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-6">
                                <?= $form->field($record1, 'Remarks');?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-6">
                                <?= $form ->field($record, 'ID')->dropDownList(
                                    ArrayHelper::map(Records::find()->all(),'ID','Name'),
                                    ['prompt'=> 'Select Product']
                                );?>
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
                                <div class="col-lg-2" style="margin-right: 10px;">
                                    <span><?= Html::submitbutton('Withdraw', ['class'=>'btn btn-primary']);?></span>
                                </div>
                                <div class="col-lg-2">
                                    <span><?= Html::a('Cancel', ['/pharmacy/withdrawals'], ['class' => 'btn btn-primary'])?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

    </div>
</div>