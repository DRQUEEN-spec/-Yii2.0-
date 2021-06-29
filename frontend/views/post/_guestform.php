<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .form-group button {
        background-color: #1e1879 !important;
        border: none;
        border-radius: 8px;
    }

    .form-group button:hover {
        box-shadow: 0 6px 10px 0 rgba(31, 38, 135, 0.37);
        transition: .3s;
    }
</style>
<div class="comment-form">

    <?php $form = ActiveForm::begin([
        'action' => ['post/detail', 'id' => $id, '#' => 'comments'],
        'method' => 'post',
    ]); ?>

    <div class="row">
        <div class="col-md-12">
            <br>
            <?= $form->field($commentModel, 'content')->textarea(['row' => 8]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('发送弹幕', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>