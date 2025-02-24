<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = '404 Not Found';
?>
<div class="site-error text-center">
    <div class="jumbotron bg-transparent">
        <img src="<?= Yii::getAlias('@web') . '/upload/cat404.webp' ?>"
             alt="404 Not Found"
             style="width: 300px; height: auto; margin-bottom: 20px;">
        <h1 class="display-4">Упс! Ошибка 404</h1>
        <p class="lead">Похоже, страница, которую вы ищете, не существует.</p>
        <p class="text-muted"><?= nl2br(Html::encode($message)) ?></p>
        <p>
            <a class="btn btn-lg btn-dark" href="<?= Yii::$app->homeUrl ?>">Вернуться на главную</a>
        </p>
    </div>
</div>
