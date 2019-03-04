<?php
use yii\helpers\Html;
?>
<div class="pdf-dealer container">
    <h2 style="text-align: center;">Farmako Inventus Inventory</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Generic Name</td>
                <th>Strength</td>
                <th>Brand</td>
                <th>Manufacturer</td>   
                <th>Category</td> 
                <th>Quantity</td>
                <th>Unit Price</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $key => $value): ?>
                <?php foreach ($value as $newKey => $value1): ?>
                    <tr>
                        <td><?= $value[0]['generic_name'] ?></td>
                        <td><?= $value[0]['strength'] ?></td>
                        <td><?= $value[0]['brand'] ?></td>
                        <td><?= $value[0]['manufacturer'] ?></td>
                        <td><?= $value[0]['category'] ?></td>
                        <td><?= $value[0]['quantity'] ?></td>
                        <td><?= $value[0]['unit_price'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>