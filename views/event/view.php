<?php
/** @var yii\web\View $this */
/** @var app\models\Events $model */

use app\models\EventTypes;
use yii\helpers\Html;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мероприятия', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <img src="<?= $model->image ?? Yii::getAlias('@web') . '/upload/events/default.webp' ?>"
                 alt="<?= Html::encode($model->name) ?>"
                 style="width: 100%; height: auto; border-radius: 10px; object-fit: cover;">
        </div>
        <div class="col-lg-6">
            <p><strong>Формат:</strong> <?= Html::encode($model->type === EventTypes::TYPE_OFFLINE ? 'Оффлайн' : 'Онлайн') ?></p>
            <p><strong>Дата и время начала:</strong> <?= Yii::$app->formatter->asDatetime($model->start_date, 'php:d.m.Y H:i') ?></p>
            <p><strong>Дата и время окончания:</strong> <?= Yii::$app->formatter->asDatetime($model->end_date, 'php:d.m.Y H:i') ?></p>
            <?php if ($model->type === EventTypes::TYPE_OFFLINE): ?>
                <p><strong>Адрес:</strong> <?= Html::encode($model->address) ?></p>
            <?php endif; ?>
            <p><strong>Описание:</strong></p>
            <p><?= Html::encode($model->description) ?></p>
            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить это мероприятие?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
</div>
