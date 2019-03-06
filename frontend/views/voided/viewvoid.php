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
                <span><strong>VOID NO.: </strong></span><i><?php echo $model->voidno;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>SKU: </strong></span><i><?php echo $model->sku;?></i>
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
                <span><strong>CATEGORY: </strong></span><i><?php echo $model->category;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>STOCK: </strong></span><i><?php echo $model->stock;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>UNIT: </strong></span><i><?php echo $model->unit;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>UNIT PRICE: </strong></span><i><?php echo $model->unit_price;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>CREATED DATE: </strong></span><i><?php echo $model->created_date;?></i>
            </li>
            <?php Pjax::end(); ?>
        </ul>
    </div>
</div>
