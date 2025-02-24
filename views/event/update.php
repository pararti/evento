<?php
/** @var yii\web\View $this */
/** @var app\models\Events $model */
/** @var yii\bootstrap5\ActiveForm $form */

use app\models\EventTypes;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Редактирование мероприятия: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мероприятия', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="event-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="event-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'type')->dropDownList([
            EventTypes::TYPE_ONLINE => 'Онлайн',
            EventTypes::TYPE_OFFLINE => 'Оффлайн',
        ], [
            'prompt' => 'Выберите тип мероприятия',
            'onchange' => '
                if ($(this).val() === "offline") {
                    $("#address-field").show();
                } else {
                    $("#address-field").hide();
                }
            ',
        ]) ?>

        <div id="address-field" style="display: <?= $model->type === EventTypes::TYPE_OFFLINE ? 'block' : 'none' ?>;">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>

        <?= $form->field($model, 'start_date')->input('datetime-local', [
            'value' => $model->start_date ? date('Y-m-d\TH:i', strtotime($model->start_date)) : '',
        ]) ?>

        <?= $form->field($model, 'end_date')->input('datetime-local', [
            'value' => $model->end_date ? date('Y-m-d\TH:i', strtotime($model->end_date)) : '',
        ]) ?>

        <?= $form->field($model, 'image')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
