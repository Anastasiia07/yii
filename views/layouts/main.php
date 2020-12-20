<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Trips</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Trips',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],

    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            //['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'Users', 'url' => ['/admin/user'],
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->login == 'anastasiia@gmail.com'],
            ['label' => 'Article', 'url' => ['/admin/article'],
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->login == 'anastasiia@gmail.com'],
            ['label' => 'Comments', 'url' => ['/admin/comment'],
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->login == 'anastasiia@gmail.com'],
            ['label' => 'Topic', 'url' => ['/admin/topic'],
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->login == 'anastasiia@gmail.com'],
            ['label' => 'My profile', 'url' => ['/user/user'],
                'visible' => !Yii::$app->user->isGuest],
            ['label' => 'My articles', 'url' => ['/user/article'],
                'visible' => !Yii::$app->user->isGuest],
            ['label' => 'About', 'url' => ['/about']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/auth/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/auth/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">

        <!--main content start-->

        <div class="main-content">

            <div class="container">

                <div class="row">

                    <?= $content ?>

                </div>

            </div>

        </div>

    </div>

</div>

<footer class="footer">

    <div class="container">

        <p class="pull-left">&copy; Travelling in <?= date('Y') ?></p>

    </div>

</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
