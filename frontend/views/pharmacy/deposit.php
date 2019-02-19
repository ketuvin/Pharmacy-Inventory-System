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
<div class="pharmacy-deposit">
    <div class="body-deposit">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="deposit-container">
                        <?php if(Yii::$app->session->hasFlash('message')): ?>
                            <div class="alert alert-dismissible alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::$app->session->getFlash('message');?>
                            </div>
                        <?php endif;?>
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">DEPOSIT</h1>
                        </div>
                        <?php
                        $form = ActiveForm::begin(); 
                        ?>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-6">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-6">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <div class="col-lg-3">
                                        <span><?= Html::submitbutton('Deposit Stock', ['class'=>'btn btn-primary']);?></span>
                                    </div>
                                    <div class="col-lg-2" style="padding-left: 3px;">
                                        <span><?= Html::a('Cancel', ['/pharmacy/deposit'], ['class' => 'btn btn-primary'])?></span>
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
</div>