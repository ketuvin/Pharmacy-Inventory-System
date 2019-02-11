<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\sidenav\SideNav;
/* @var $this yii\web\View */

$this->title = 'YII2 CRUD Application';
?>
<div class="pharmacy-dashboard">
    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>

    <div class="body-dashboard">
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
                    <div class="dash-container">
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">Overview</h1>
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
