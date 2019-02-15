<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\sidenav\SideNav;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-changePassword">
    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>

    <div class="body-changePassword">
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
                                'url' => ['/pharmacy/withdrawals'],
                                'label' => 'Withdraw',
                                'icon' => 'minus-sign'
                            ],
                            [
                                'url' => ['/pharmacy/category'],
                                'label' => 'Category',
                                'icon' => 'tags'
                            ],
                            [
                                'url' => ['/pharmacy/unit'],
                                'label' => 'Unit',
                                'icon' => 'scale'
                            ],
                            [
                                'label' => 'User Management',
                                'icon' => 'user',
                                'items' => [
                                    [
                                        'label' => 'Change Password',
                                        'icon' => 'edit', 
                                        'url' => ['/user/changepassword']
                                    ],
                                    [
                                        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                        'icon'=> 'log-out',
                                        'url' => Url::to(['/site/logout']), 
                                        'template' => '<a href="{url}" data-method="post">{icon}{label}</a>'
                                    ],
                                ],
                            ],
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-8">
                    <div class="changePassword-container">
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">Change Password</h1>
                        </div>
                        <?php $form = ActiveForm::begin(); ?>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <?= $form->field($user, 'currentPassword')->passwordInput(); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <?= $form->field($user, 'newPassword')->passwordInput(); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <?= $form->field($user, 'newPasswordConfirm')->passwordInput(); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <div class="col-lg-1">
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                                    </div>
                                     <div class="col-lg-2" style="padding-left: 28px;">
                                        <span><?= Html::a('Cancel', ['/user/changepassword'], ['class' => 'btn btn-primary'])?></span>
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
   <!--  <script type="text/javascript">
        $(function() {
            var href = window.location.href;
            $('div a').each(function(e,i) {
                if (href.indexOf($(this).attr('href')) >= 0) {
                    $(this).addClass('active');
                }
            });
        });
    </script> -->
</div>
