<?php


namespace app\controllers;
 
use yii\web\Controller;
use app\models\TestForm;
 
class TestController extends Controller
{
 
    public function actionIndex()
    {
        return $this->render('index');
    }
 
    public function actionPage()
    {
        $form_model = new TestForm();
		
        return $this->render('page', compact('form_model'));
    }
 
}