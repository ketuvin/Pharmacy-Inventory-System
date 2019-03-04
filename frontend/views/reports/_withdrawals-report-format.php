<?php
use yii\helpers\Html;
?>
<div class="pdf-dealer container">
    <h2 style="text-align: center;">Farmako Inventus</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pull-out No.</td>
                <th>Remarks</td>
                <th>Generic Name</td>
                <th>Strength</td>   
                <th>Brand</td> 
                <th>Manufacturer</td>
                <th>Amount of Stock Withdrawn</td>
                <th>Current Stock After Withdraw</td>
                <th>Withdrawn By</td>
                <th>Created Date</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $key => $value): ?>
                    <tr>
                        <td><?= $value['pull_outno'] ?></td>
                        <td><?= $value['remarks'] ?></td>
                        <td><?= $value['product_name'] ?></td>
                        <td><?= $value['strength'] ?></td>
                        <td><?= $value['brand'] ?></td>
                        <td><?= $value['manufacturer'] ?></td>
                        <td><?= $value['stock_withdrawn'] ?></td>
                        <td><?= $value['current_stock'] ?></td>
                        <td><?= $value['withdrawby_user'] ?></td>
                        <td><?= $value['created_date'] ?></td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>