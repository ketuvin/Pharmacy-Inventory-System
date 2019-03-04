<?php
use yii\helpers\Html;
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
                <span><strong>CATEGORY: </strong></span><i><?php echo $record->category;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>CATEGORY DESCRIPTION: </strong></span><i><?php echo $record1->description;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>GENERIC NAME: </strong></span><i><?php echo $record->generic_name;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>STRENGTH: </strong></span><i><?php echo $record->strength;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>BRAND: </strong></span><i><?php echo $record->brand;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>MANUFACTURER: </strong></span><i><?php echo $record->manufacturer;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>UNIT PRICE: </strong></span><i><?php echo $record->unit_price;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>STOCK: </strong></span><i><?php echo $record->quantity;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>UNIT: </strong></span><i><?php echo $record->unit;?></i>
            </li>
            <?php Pjax::end(); ?>
        </ul>

    </div>
</div>
