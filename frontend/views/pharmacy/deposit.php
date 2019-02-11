<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use kartik\sidenav\SideNav;
use yii\widgets\ActiveForm;
use app\models\Records;
/* @var $this yii\web\View */

$this->title = 'YII2 CRUD Application';
?>
<div class="pharmacy-deposit">
    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>

    <div class="body-deposit">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- It can be fixed with bootstrap affix http://getbootstrap.com/javascript/#affix-->
                    <?php
                    echo SideNav::widget([
                        'type' => SideNav::TYPE_DEFAULT,
                        'heading' => '<i class="glyphicon glyphicon-cog"></i> Main Navigation',
                        'items' => [
                            [
                                'url' => ['/pharmacy/dashboard'],
                                'label' => 'Overview',
                                'icon' => 'dashboard'
                            ],
                            [
                                'url' => ['/pharmacy/home'],
                                'label' => 'Medicines',
                                'icon' => 'list-alt'
                            ],
                            [
                                'url' => ['/pharmacy/deposit'],
                                'label' => 'Deposit',
                                'icon' => 'plus-sign'
                            ],
                            [
                                'url' => ['/pharmacy/withdraw'],
                                'label' => 'Withdraw',
                                'icon' => 'minus-sign'
                            ],
                            [
                                'label' => 'User Management',
                                'icon' => 'user',
                                'items' => [
                                    ['label' => 'Change Password', 'icon'=>'check', 'url'=>['/pharmacy/changepassword']],
                                ],
                            ],
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-8">
                    <div class="deposit-container">
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
                                    <div class="col-lg-2" style="padding-left: 25px;">
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