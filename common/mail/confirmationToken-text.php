<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlFrontEndManager->createAbsoluteUrl(['site/confirmation', 'token' => $user->confirmation_token]);
?>
Hello <?= $user->username ?>,

Clink the link below to confirm your account:

<?= $resetLink ?>
