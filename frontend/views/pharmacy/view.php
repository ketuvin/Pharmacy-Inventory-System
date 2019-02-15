<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Pharmacy Inventory System';
?>
<div class="pharmacy-view">

    <h1>VIEW PRODUCT</h1>
   
    <div class="body-view">
        <div class="row" style="text-align: center;">
            <ul class="list-group" style="color: #000; width: 90%; display: inline-block; text-align: left;">
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
        </ul>
        </div>

        <div class="row">
            <span><?= Html::a('Back', ['/pharmacy/home'], ['class' => 'btn btn-primary'])?></span>
        </div>
    </div>
</div>
