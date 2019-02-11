<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\sidenav\SideNav;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'YII2 CRUD Application';
?>
<div class="site-home">
    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>

    <div class="body-home">
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
                                'url' => ['/site/dashboard'],
                                'label' => 'Overview',
                                'icon' => 'dashboard'
                            ],
                            [
                                'url' => ['/site/home'],
                                'label' => 'Medicines',
                                'icon' => 'list-alt'
                            ],
                            [
                                'url' => ['/site/deposit'],
                                'label' => 'Deposit',
                                'icon' => 'plus-sign'
                            ],
                            [
                                'url' => ['/site/withdraw'],
                                'label' => 'Withdraw',
                                'icon' => 'minus-sign'
                            ],
                            [
                                'label' => 'User Management',
                                'icon' => 'user',
                                'items' => [
                                    ['label' => 'Change Password', 'icon'=>'check', 'url'=>['/site/changepassword']],
                                ],
                            ],
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-8">
                    <div class="home-container">
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">Medicines</h1>
                            <span style="margin-bottom: 20px;"><?= Html::a('Add Product', ['/site/create'], ['class' => 'btn btn-success'])?></span>
                            <span><?= Html::a('Deposit', ['/site/deposit'], ['class' => 'btn btn-success'])?></span>
                            <span><?= Html::a('Withdraw', ['/site/withdraw'], ['class' => 'btn btn-success'])?></span>
                        </div>

                        <div class="row" style="margin-top: 30px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                    <th scope="col">Category</th>
                                    <th scope="col">Category Description</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($records) > 0): ?>
                                        <?php foreach($records as $record): ?>
                                        <tr class="table-active">
                                            <th scope="row"><?php echo $record->Category; ?></th>
                                            <td>
                                            <?php 
                                            foreach($category as $categ):
                                                if($record->Category==$categ->Name){
                                                    echo $categ->Description;
                                                }
                                            endforeach;   
                                            ?>
                                            </td>
                                            <td><?php echo $record->Name; ?></td>
                                            <td><?php echo $record->Brand; ?></td>
                                            <td><?php echo $record->Quantity; ?></td>
                                            <td>
                                                <span><?= Html::a('View', ['view', 'ID' => $record->ID], ['class' => 'label label-primary']) ?></span>
                                                <span><?= Html::a('Update', ['update', 'ID' => $record->ID, 'Category' => $record->Category], ['class' => 'label label-default']) ?></span>
                                                <span><?= Html::a('Add Stock', ['addstock', 'ID' => $record->ID], ['class' => 'label label-success']) ?></span>
                                               
                                            </td>
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