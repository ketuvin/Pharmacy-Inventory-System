<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-withdrawals">
    <div class="body-withdrawals">
        <div class="container">
            <div class="row" id="medicine-home">
                <div class="col-md-8">
                    <div class="withdrawals-container">
                        <div class="row">
                            <h1>Withdrawals</h1>
                        </div>
                        <?php Pjax::begin(); ?>
                        <div class="row">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                    <th scope="col">Pull-out No.</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Withdrawn By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($withdrawals) > 0): ?>
                                        <?php foreach($withdrawals as $withdraw): ?>
                                        <tr class="table-active">
                                            <th scope="row">PN.000<?php echo $withdraw->Pull_outNo; ?></th>
                                            <td><?php echo $withdraw->Remarks; ?></td>
                                            <td><?php echo $withdraw->Created_Date; ?></td>
                                            <td><?php echo $withdraw->withdrawby_user; ?></td>
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
                        <?php Pjax::end(); ?>
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