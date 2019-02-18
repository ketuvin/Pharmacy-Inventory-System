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
<div class="pharmacy-category">

    <div class="body-category">
        <?php
            $form = ActiveForm::begin(); 
        ?>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form ->field($category, 'Name');?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form ->field($category, 'Description')->textarea(['rows' => '5']);?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <div class="col-lg-2">
                        <span><?= Html::submitbutton('Save', ['class'=>'btn btn-primary']);?></span>
                    </div>
                    <div class="col-lg-2">
                        <span><?= Html::a('Cancel', ['/pharmacy/category'], ['class' => 'btn btn-primary'])?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>