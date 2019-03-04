<?php

use yii\helpers\Html;


$this->title = 'Create Reports';
?>
<div class="reports-create">

    <?= $this->render('_withdrawalreport', [
        'model' => $model,
    ]) ?>

</div>