<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-admin">
    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>

    <?php
        Modal::begin([
            'header' => '<h3 style="text-align:center;">ADD USER</h3>',
            'id' => 'modalUser',
            'size' => 'modal-md',
        ]);

        echo "<div id='modalContent'></div>";

        Modal::end();
    ?>

    <div class="body-admin">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="admin-container">
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">View Users</h1>
                            <span style="margin-bottom: 20px;">
                                <?= Html::button('Add User', ['value' => Url::to(['/site/adduser']), 'class' => 'btn btn-success', 'id' => 'modalButton'])?>
                            </span>
                        </div>

                        <div class="row" style="margin-top: 30px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Confirmation Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($users) > 0): ?>
                                        <?php foreach($users as $user): ?>
                                        <tr class="table-active">
                                            <th scope="row"><?php echo $user->username; ?></th>
                                            <td><?php echo $user->email; ?></td>
                                            <td><?php echo $user->fullname; ?></td>
                                            <td><?php 
                                                if($user->confirm_status == 10) {
                                                    echo '<p style="color:green"><strong>Confirmed</strong></p>';
                                                }else{
                                                    echo '<p style="color:red"><strong>Not Confirmed</strong></p>';
                                                }
                                            ?></td>
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
</div>