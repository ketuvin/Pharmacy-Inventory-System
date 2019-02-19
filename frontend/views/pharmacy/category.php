<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-home">
    <div class="body-home">
        <div class="container">
            <div class="row" id="medicine-home">
                    <?php
                        Modal::begin([
                            'header' => '<h3 style="text-align:center;">EDIT CATEGORY</h3>',
                            'id' => 'modalCategory',
                            'size' => 'modal-md',
                        ]);

                        echo "<div id='editCategory'></div>";

                        Modal::end();
                    ?>
                <div class="col-md-8">
                    <div class="home-container">
                        <?php if(Yii::$app->session->hasFlash('message')): ?>
                            <div class="alert alert-dismissible alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::$app->session->getFlash('message');?>
                            </div>
                        <?php endif;?>
                        <div class="row">
                            <h1 style="margin-bottom: 10px;">Category</h1>
                        </div>

                        <div class="row" style="margin-top: 30px;">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                    <th scope="col">Category</th>
                                    <th scope="col">Description</th>
                                   <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($category) > 0): ?>
                                        <?php foreach($category as $categ): ?>
                                        <tr class="table-active">
                                            <th scope="row"><?php echo $categ->Category; ?></th>
                                            <td><?php echo $categ->Description; ?></td>
                                            <td>
                                                <span><?= Html::button('Edit', ['value' => Url::to(['pharmacy/edit', 'categID' => $categ->categID]), 'class' => 'label label-primary modalButtonCategory']) ?></span>
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