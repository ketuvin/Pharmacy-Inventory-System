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
<?php if(Yii::$app->session->hasFlash('message')): ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo Yii::$app->session->getFlash('message');?>
    </div>
<?php endif;?>
<div class="pharmacy-unit">
    <div class="body-unit">
        <div class="container">
            <div class="row">
                <div class="col-md-8" style="background-color: transparent; padding-left: 10px; width: 200%;">
                    <div class="unit-container">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                    $form = ActiveForm::begin(['id' => 'addunit-form']); 
                                ?>

                                <?= $form ->field($unit, 'Unit_name'); ?>

                                <div class="form-group">
                                    <div class="col-lg-2">
                                        <span><?= Html::submitbutton('Add Unit', ['class'=>'btn btn-primary']);?></span>
                                    </div>
                                    <div class="col-lg-2" style="padding-left: 10px;">
                                        <span><?= Html::a('Cancel', ['/pharmacy/unit'], ['class' => 'btn btn-primary'])?></span>
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
</div>