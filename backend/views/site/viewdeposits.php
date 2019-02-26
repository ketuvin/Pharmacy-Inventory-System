<?php
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-view">
    <div class="body-view">
        <ul class="list-group" style="width: 50%;">
            <?php Pjax::begin(); ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>DEPOSIT NO.: </strong></span><i><?php echo $model->depositno;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>PRODUCT NAME: </strong></span><i><?php echo $model->product_name;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>CATEGORY: </strong></span><i><?php echo $model->category;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>AMOUNT OF STOCK DEPOSITED: </strong></span><i><?php echo $model->stock_deposited;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>CURRENT STOCK AFTER DEPOSIT: </strong></span><i><?php echo $model->current_stock;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>CREATED DATE: </strong></span><i><?php echo $model->created_date;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>DEPOSITED BY: </strong></span><i><?php echo $model->depositedby_user;?></i>
            </li>
            <?php Pjax::end(); ?>
        </ul>
    </div>
</div>
