<?php

namespace app\controllers;

use app\models\EventCreateForm;
use app\models\Events;
use app\models\EventTypes;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class EventController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::class,
//                'actions' => [
//                    'delete' => ['delete'],
//                ],
//            ],
//        ];
//    }

    public function actionCreate()
    {
        $model = new EventCreateForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->create()) {
                Yii::$app->session->setFlash('success', 'Мероприятие успешно создано');
                return $this->redirect(['site/index']);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        $event = Events::findOne($id);

        if (!$event) {
            Yii::$app->response->setStatusCode(404);
            return $this->redirect('site/error');
        }

        if (!$event->isOwner()) {
            throw new ForbiddenHttpException();
        }

        $event->is_deleted = 1;
        if ($event->update()) {
            Yii::$app->session->setFlash('success', 'Мероприятие успешно удалено');
            return $this->goHome();
        }

        return $this->goBack();
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $event = Events::find()->where(['id' => $id, 'is_deleted' => 0])->one();

        if (!$event) {
            throw new NotFoundHttpException();
        }

        if (!$event->isOwner()) {
            throw new ForbiddenHttpException('Forbidden', 403);
        }

        $eventForm = new EventCreateForm();
        if ($eventForm->load(Yii::$app->request->post())) {

            if ($eventForm->update($id)) {
                Yii::$app->session->setFlash('success', 'Мероприятие успешно обновлено');
                return $this->goBack();
            }
        }

        return $this->render('update', ['model' => $event]);
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $event = Events::find()->where(['id' => $id, 'is_deleted' => 0])->one();

        if (!$event) {
            Yii::$app->response->setStatusCode(404);
            return $this->redirect('site/error');
        }

        return $this->render('view', ['model' => $event]);
    }

}
