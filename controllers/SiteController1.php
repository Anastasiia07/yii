<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\EntryForm;

class SiteController1 extends Controller
{
    // ...наявний код...

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
}