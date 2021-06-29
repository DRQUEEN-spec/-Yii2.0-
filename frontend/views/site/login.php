<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    div.site-login {
        background: rgba(255, 255, 255, 0.65);
        box-shadow: 0 8px 20px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(5.0px);
        -webkit-backdrop-filter: blur(5.0px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    div.site-login h1 {
        text-align: center;
    }

    #signup {
        margin: 0 auto;
        width: 302px;
    }

    #loginbtn {
        visibility: hidden;
    }

    #TencentCaptcha{
        width: 300px;
        height: 30px;
    }
</style>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div id="signup">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <button id="TencentCaptcha" data-appid="2041127177" data-cbfn="btncallback" type="button">登录前请先验证</button>

            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
            </div>

            <div class="form-group" id="loginbtn">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
<script>
    window.btncallback = (res) => {
        if (res.ret === 0) {
            document.getElementById("loginbtn").style.visibility = "visible";
        }
    }
</script>