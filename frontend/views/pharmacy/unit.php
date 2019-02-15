<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-unit">
    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>

    <div class="body-unit">
        <div class="container">
            <div class="row" id="medicine-home">
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
                    <div class="unit-container">
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">Units</h1>
                            <span style="margin-bottom: 20px;"><?= Html::button('Add Unit', ['value' => Url::to(['/pharmacy/addunit']), 'class' => 'btn btn-success', 'id' => 'modalButtonUnit'])?></span>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">ADD UNIT</h3>',
                                    'id' => 'modalUnit',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='addUnit'></div>";
                                
                                Modal::end();
                            ?>
                        </div>

                        <div class="row" style="margin-top: 30px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                    <th scope="col">Unit Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($units) > 0): ?>
                                        <?php foreach($units as $unit): ?>
                                        <tr class="table-active">
                                            <th scope="row"><?php echo $unit->Unit_name; ?></th>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td>No Records Found!</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table> 
                            <div style="text-align: center;">
                                <?php echo LinkPager::widget(['pagination' => $pages,]);?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- <script type="text/javascript">
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