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
                <span><strong>PULL-OUT NO.: </strong></span><i><?php echo $model->Pull_outNo;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>REMARKS: </strong></span><i><?php echo $model->Remarks;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>PRODUCT NAME: </strong></span><i><?php echo $model->Product_name;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>AMOUNT OF STOCK WITHDRAWN: </strong></span><i><?php echo $model->stock_withdrawn;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>CREATED DATE: </strong></span><i><?php echo $model->Created_Date;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>WITHDRAWN BY: </strong></span><i><?php echo $model->withdrawby_user;?></i>
            </li>
            <?php Pjax::end(); ?>
        </ul>
    </div>
</div>
