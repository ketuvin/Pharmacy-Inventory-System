<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\base\Component;
use kartik\icons\Icon;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

Icon::map($this);  

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
        ];
        $menuItemsLogged = [
            ['label' => 'Dashboard', 'url' => ['/pharmacy/dashboard']], 
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
        ];
        if (Yii::$app->user->isGuest) {
            NavBar::begin([
                'brandLabel' => Html::img('@web/pharmacy.png', ['style' => 'display:inline;']) . ' ' . Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'my-navbar navbar-fixed-top',
                ],
            ]);
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        } else {
            NavBar::begin([
                'brandLabel' => Html::img('@web/pharmacy.png', ['style' => 'display:inline;']) . ' ' . Yii::$app->name,
                'brandUrl' => ['/pharmacy/dashboard'],
                'options' => [
                    'class' => 'my-navbar navbar-fixed-top',
                ],
            ]);
            $menuItemsLogged[] = [
                'label' => Icon::show('cog'),
                'items' => [
                    [
                        'label' => Icon::show('edit') . 'Change Password',
                        'url' => ['/user/changepassword']
                    ],
                    [
                        'label' => Icon::show('log-out') . 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post'],
                    ], 
                ],
            ];

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItemsLogged,
                'encodeLabels' => false,
            ]);
            NavBar::end();
        }
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
