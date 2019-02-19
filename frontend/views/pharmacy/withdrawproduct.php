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
    <div class="body-withdraw">
        <div class="container">
            <div class="row">
                <div class="col-md-8" style="background-color: transparent; padding-left: 25px; width: 200%;">

                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            $form = ActiveForm::begin(['id' => 'withdrawproduct-form']); 
                            ?>
                            <?= $form->field($record1, 'Remarks');?>

                            <?= $form ->field($record, 'Name')->dropDownList(
                                ArrayHelper::map(Records::find()->all(),'ID','Name'),
                                ['prompt'=> 'Select Product']
                            );
                            ?>

                            <?= $form->field($record, 'Re_stock');?>

                            <div class="col-lg-2" style="margin-right: 10px;">
                                <span><?= Html::submitbutton('Withdraw', ['class'=>'btn btn-primary']);?></span>
                            </div>
                            <div class="col-lg-2">
                                <span><?= Html::a('Cancel', ['/pharmacy/withdrawals'], ['class' => 'btn btn-primary'])?></span>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>