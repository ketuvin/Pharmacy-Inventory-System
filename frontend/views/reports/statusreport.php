<?php

use yii\helpers\Html;


$this->title = 'Create Reports';
?>
<div class="reports-create">

    <?= $this->render('_statusreport', [
        'model' => $model,
    ]) ?>

</div>