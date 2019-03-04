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
                <span><strong>PULL-OUT NO.: </strong></span><i><?php echo $model->pull_outno;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>REMARKS: </strong></span><i><?php echo $model->remarks;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>GENERIC NAME: </strong></span><i><?php echo $model->product_name;?></i>
            </li>
             <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>STRENGTH: </strong></span><i><?php echo $model->strength;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>BRAND: </strong></span><i><?php echo $model->brand;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>MANUFACTURER: </strong></span><i><?php echo $model->manufacturer;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>AMOUNT OF STOCK WITHDRAWN: </strong></span><i><?php echo $model->stock_withdrawn;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>CURRENT STOCK AFTER WITHDRAW: </strong></span><i><?php echo $model->current_stock;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>CREATED DATE: </strong></span><i><?php echo $model->created_date;?></i>
            </li>
            <?php Pjax::end(); ?>
        </ul>
    </div>
</div>
