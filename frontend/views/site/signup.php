<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    div.site-signup {
        background: rgba(255, 255, 255, 0.65);
        box-shadow: 0 8px 20px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(5.0px);
        -webkit-backdrop-filter: blur(5.0px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    div.site-signup h1 {
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
        margin-bottom: 30px;
    }
</style>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div id="signup">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <button id="TencentCaptcha" data-appid="2041127177" data-cbfn="btncallback" type="button">注册前请先验证</button>

            <div class="form-group" id="loginbtn">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
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
            document.getElementById("TencentCaptcha").innerText = "验证通过";
        }
    }
</script>