<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\Article;
use app\models\Topic;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
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

// build a DB query to get all articles

        $query = Article::find();
        $popular = Article::find()->orderBy('viewed desc')->limit(3)->all();

        $recent = Article::find()->orderBy('date desc')->limit(3)->all();

        $topics = Topic::find()->all();

// get the total number of articles (but do not fetch the article data yet)

        $count = $query->count();

// create a pagination object with the total count

        $pagination = new Pagination(['totalCount' => $count, 'pageSize'=> 1]);

// limit the query using the pagination and retrieve the articles

        $articles = $query->offset($pagination->offset)

            ->limit($pagination->limit)

            ->all();

        return $this->render('index',[

            'articles'=>$articles,

            'pagination'=>$pagination,
            'popular' => $popular,
            'recent' => $recent,
            'topics' => $topics

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
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
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


    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // дані в $model успішно перевірені

            // тут робимо щось корисне з $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // або сторінка відображається вперше, або ж є помилка в даних
            return $this->render('entry', ['model' => $model]);
        }
    }


    public function actionView()
    {
        return $this->render('single');
    }
}