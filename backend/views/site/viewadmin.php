<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = 'YII2 CRUD Application';
?>
<div class="pharmacy-admin">
    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>

    <div class="body-admin">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="admin-container">
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">View Users</h1>
                            <span style="margin-bottom: 20px;"><?= Html::a('Add Users', ['/site/adduser'], ['class' => 'btn btn-success'])?></span>
                        </div>

                        <div class="row" style="margin-top: 30px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Full Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($users) > 0): ?>
                                        <?php foreach($users as $user): ?>
                                        <tr class="table-active">
                                            <th scope="row"><?php echo $user->username; ?></th>
                                            <td><?php echo $user->email; ?></td>
                                            <td><?php echo $user->fullname; ?></td>
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