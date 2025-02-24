<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\EventForm $model */

use app\models\EventTypes;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Создать мероприятие';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-create-event">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Заполните необходимые поля для создания мероприятия.
    </p>

    <div class="row">
        <div class="col-lg-6">

            <?php $form = ActiveForm::begin(['id' => 'event-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Название *') ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Описание *') ?>

            <?= $form->field($model, 'startDate')->input('datetime-local')->label('Начало *') ?>

            <?= $form->field($model, 'endDate')->input('datetime-local')->label('Завершение *') ?>

            <?= $form->field($model, 'type')->dropDownList(
                [EventTypes::TYPE_ONLINE => 'Онлайн', EventTypes::TYPE_OFFLINE => 'Оффлайн'],
                ['prompt' => 'Выберите формат', 'id' => 'event-type']
            )->label('Формат *') ?>

            <div id="offline-fields" style="display: none;">
                <?= $form->field($model, 'address')->textInput()->label('Адрес *') ?>
            </div>

            <?= $form->field($model, 'image')->fileInput()->label('Загрузить обложку') ?>

            <div class="form-group">
                <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'event-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const eventTypeField = document.getElementById('event-type');
        const offlineFields = document.getElementById('offline-fields');

        eventTypeField.addEventListener('change', function () {
            if (this.value == 1 ) {
                offlineFields.style.display = 'block';
            } else {
                offlineFields.style.display = 'none';
            }
        });
    });
</script>
