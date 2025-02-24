<?php

namespace app\controllers;

use app\models\EventCreateForm;
use app\models\Events;
use app\models\RegisterForm;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Events::find()
            ->where(['is_deleted' => 0, 'is_cancelled' => 0])
            ->where(['>=', 'start_date', date('Y-m-d H:i:s')])
            ->orderBy(['start_date' => SORT_ASC]);

        $queryCount = clone $query;

        $pagination = new Pagination([
            'totalCount' => $queryCount->count(),
            'defaultPageSize' => 9,
        ]);

        $events = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'events' => $events,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model->setScenario(LoginForm::SCENARIO_GET);
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->execute()) {
                return $this->goBack();
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->execute()) {
                return $this->goBack();
            }
        }

        $model->password = '';
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionEventCreate()
    {
        $model = new EventCreateForm();

        return $this->render('event-create', [
            'model' => $model,
        ]);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;

        return match($exception?->statusCode) {
            403 => $this->render('error-403'),
            default => $this->render('error'),
        };
    }
}
