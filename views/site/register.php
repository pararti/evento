<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var bool $isGet */
/** @var string $email */

/** @var \yii\base\Model $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-7 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Имя'); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true])->input('email'); ?>

            <?= $form->field($model, 'password')->passwordInput()->label('Пароль');  ?>

            <?= $form->field($model, 'password_repeat')->passwordInput()->label('Подтвердите пароль'); ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton( 'Регистрация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

            <div style="color:#999;">
                Нажимая на кнопку регистрации вы даёте согласие на обработку персональных данных.<br>
            </div>

        </div>
    </div>
</div>
