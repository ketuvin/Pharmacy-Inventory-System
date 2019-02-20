<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-dashboard">
    <div class="body-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="dash-container">
                        <?php if(Yii::$app->session->hasFlash('message')): ?>
                            <div class="alert alert-dismissible alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::$app->session->getFlash('message');?>
                            </div>
                        <?php endif;?>
                        <?php if(Yii::$app->session->hasFlash('success')): ?>
                            <div class="alert alert-dismissible alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::$app->session->getFlash('success');?>
                            </div>
                        <?php endif;?>
                        <?php if(Yii::$app->session->hasFlash('error')): ?>
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::$app->session->getFlash('error');?>
                            </div>
                        <?php endif;?>
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">Overview</h1>
                        </div>
                        <div class="row">
                            <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                       'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                       'modules/exporting', // adds Exporting button/menu to chart
                                       // 'themes/grid-light'        // applies global 'grid' theme to all charts
                                    ],
                                    'options' => [
                                        'title' => ['text' => 'Inventory'],
                                        'yAxis' => [
                                            'title' => ['text' => 'Units']
                                        ],
                                        'chart' => [
                                            'type' => 'column'
                                        ],
                                        'series' => [
                                            ['name' => 'Capsule', 'data' => [7]],
                                            ['name' => 'Tablet', 'data' => [5]]
                                        ]
                                   ]
                               ]);
                            ?>
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
