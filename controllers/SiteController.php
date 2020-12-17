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
use app\models\Comment;

use app\models\CommentForm;
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


    public function actionView($id)
    {

        $article = Article::findOne($id);

        $popular = Article::find()->orderBy('viewed desc')->limit(3)->all();

        $recent = Article::find()->orderBy('date desc')->limit(3)->all();

        $topics = Topic::find()->all();

        $comments = $article->comments;

        $commentsParent = array_filter($comments, function ($k) {

            return $k['comment_id'] == null;

        });

        $commentsChild = array_filter($comments, function ($k) {

            return ($k['comment_id'] != null && !$k['delete']);

        });

        $commentForm = new CommentForm();

        return $this->render('single', [

            'article' => $article,

            'popular' => $popular,

            'recent' => $recent,

            'topics' => $topics,
            'commentsParent' => $commentsParent,

            'commentsChild' => $commentsChild,

            'commentForm' => $commentForm,
        ]);
    }

    public function actionTopic($id)
    {

        $query = Article::find()->where(['topic_id'=>$id]);


        $count = $query->count();


        // create a pagination object with the total count

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 1]);


        // limit the query using the pagination and retrieve the articles

        $articles = $query->offset($pagination->offset)

            ->limit($pagination->limit)

            ->all();


        $popular = Article::find()->orderBy('viewed desc')->limit(3)->all();

        $recent = Article::find()->orderBy('date desc')->limit(3)->all();

        $topics = Topic::find()->all();

        return $this->render('topic', [

            'articles' => $articles,

            'pagination' => $pagination,

            'popular' => $popular,

            'recent' => $recent,

            'topics' => $topics,

        ]);

    }


    public function actionComment($id, $id_comment = null)
    {

        $model = new CommentForm();

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());

            if ($model->saveComment($id, $id_comment)) {

                return $this->redirect(['site/view', 'id' => $id]);

            }

        }

    }

    public function actionCommentDelete($id, $id_comment)
    {

        if (Yii::$app->request->isPost) {

            $data = Comment::findOne($id_comment);

            if ($data->user_id == Yii::$app->user->id) {

                $data->delete = true;

                $data->save(false);

            }

            return $this->redirect(['site/view', 'id' => $id]);

        }

    }

}