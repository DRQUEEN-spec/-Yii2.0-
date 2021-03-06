<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap" style="background-color: #090723">
        <?php
        NavBar::begin([
            'brandLabel' => '基于Yii2.0的个人博客',
            'brandOptions' => ['style' => 'color:#337bf5;font-size:23px'],
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        // $menuItems = [
        //     ['label' => '关于我们', 'url' => ['/site/about']],
        //     ['label' => '联系我们', 'url' => ['/site/contact']],
        // ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '退出 (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
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
            <p class="pull-left">&copy; 福州大学计算机与大数据学院 2018级信息安全 严柯寰</p>

            <p class="pull-right">
                MORE DETAILS：
                <a href="https://github.com/DRQUEEN-spec">https://github.com/DRQUEEN-spec</a>
            </p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
<style>
    .darkmode-toggle {
        font-size: 14px;
        width: 44px;
        height: 44px;
        color: #fff;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.5/lib/darkmode-js.min.js"></script>
<script>
    // 这些是这个插件的可配置项：
    var options = {
        bottom: "62px",
        right: "32px",
        left: "unset",
        time: "0.5s",
        mixColor: "#fff",
        backgroundColor: "#fff",
        buttonColorDark: "#a9a8b2",
        buttonColorLight: "#090723",
        saveInCookies: true, // 在cookie保存当前模式
        label: "切换", // 切换模式按钮图标 - 默认: ''
        autoMatchOsTheme: true
    };
    let darkmode = new Darkmode(options);
    darkmode.showWidget();
</script>