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