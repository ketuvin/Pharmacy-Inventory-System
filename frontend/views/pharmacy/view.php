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
                <span><strong>CATEGORY: </strong></span><i><?php echo $record->Category;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>CATEGORY DESCRIPTION: </strong></span><i><?php echo $record1->Description;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>PRODUCT NAME: </strong></span><i><?php echo $record->Name;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>MANUFACTURER: </strong></span><i><?php echo $record->Manufacturer;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>UNIT PRICE: </strong></span><i><?php echo $record->Unit_price;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>STOCK: </strong></span><i><?php echo $record->Quantity;?></i>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><strong>UNIT: </strong></span><i><?php echo $record->Unit;?></i>
            </li>
            <?php Pjax::end(); ?>
        </ul>

    </div>
</div>
