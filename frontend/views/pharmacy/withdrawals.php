<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-withdrawals">
    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo Yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>

    <div class="body-withdrawals">
        <div class="container">
            <div class="row" id="medicine-home">
                <div class="col-md-8">
                    <div class="withdrawals-container">
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">Withdrawals</h1>
                            <span><?= Html::button('Withdraw', ['value' => Url::to(['/pharmacy/withdrawproduct']), 'class' => 'btn btn-success', 'id' => 'modalButtonWithdraw'])?></span>
                            <?php
                                Modal::begin([
                                    'header' => '<h3 style="text-align:center;">WITHDRAW</h3>',
                                    'id' => 'modalWithdraw',
                                    'size' => 'modal-md',
                                ]);

                                echo "<div id='contentWithdraw'></div>";
                                
                                Modal::end();
                            ?>
                        </div>

                        <div class="row" style="margin-top: 30px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                    <th scope="col">Pull-out No.</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($withdrawals) > 0): ?>
                                        <?php foreach($withdrawals as $withdraw): ?>
                                        <tr class="table-active">
                                            <th scope="row"><?php echo $withdraw->Pull_outNo; ?></th>
                                            <td><?php echo $withdraw->Remarks; ?></td>
                                            <td><?php echo $withdraw->Created_Date; ?></td>
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