<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
use yii\helpers\Url;

$website = Url::base('http');;
?>
<?= 'Hello ', $user->username ?>,

<?= $record->generic_name,"'s quantity in ", Yii::$app->name, ' inventory is very low '?>.
<?= 'Please click the link below and check the inventory' ?>.

<?= $website ?>

<?= 'If you cannot click the link, please try pasting the text into your browser' ?>.
