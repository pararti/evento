<?php

/** @var yii\web\View $this */

use app\models\EventTypes;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\LinkPager;

/** @var  $pagination \yii\data\Pagination */
/** @var  $events */

$this->title = 'Главная';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Список мероприятий</h1>

        <p class="lead">Успейте подписаться на ближайшее мероприятие или создайте своё</p>

        <p><a class="btn btn-lg btn-dark" href="/event/create">Создать мероприятие</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <div class="col-lg-4 mb-3">
                        <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                            <!-- Тип мероприятия -->
                            <div style="
                                position: absolute;
                                top: 10px;
                                right: 10px;
                                background-color: rgba(0, 0, 0, 0.6);
                                color: #fff;
                                padding: 5px 10px;
                                border-radius: 5px;
                                font-size: 0.9rem;">
                                <?= Html::encode($event->type === EventTypes::TYPE_OFFLINE ? 'Оффлайн' : 'Онлайн') ?>
                            </div>
                                <img src="<?=$event->image ?? Yii::getAlias('@web') . '/upload/events/default.webp' ?>"
                                     alt="Event Image"
                                     class="card-img-top"
                                     style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= Html::encode($event->name) ?></h5>
                                <p class="card-text">
                                    <?= Html::encode(StringHelper::truncateWords($event->description, 20, '...')) ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Кнопка Подробнее -->
                                    <p>
                                        <?= Html::a('Подробнее', ['event/view', 'id' => $event->id], ['class' => 'btn btn-dark']) ?>
                                    </p>

                                    <!-- Дата и время начала -->
                                    <small class="text-muted">
                                        <?= Html::encode(Yii::$app->formatter->asDatetime($event->start_date, 'php:d.m.Y H:i')) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p>Мероприятия не найдены.</p>
                </div>
            <?php endif; ?>

        </div>

        <!-- Пагинация -->
        <div class="d-flex justify-content-center mt-4">
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'options' => ['class' => 'pagination'],
                'linkOptions' => ['class' => 'page-link'],
                'activePageCssClass' => 'active',
                'disabledPageCssClass' => 'disabled',
                'nextPageLabel' => '&raquo;',
                'prevPageLabel' => '&laquo;',
            ]) ?>
        </div>

    </div>
</div>
