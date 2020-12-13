<?php
/**
 * Created by PhpStorm.
 * User: Anastasiya
 * Date: 13.12.2020
 * Time: 13:40
 */
namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\base\Model;

class ImageUpload extends Model

{

    public $image;
    public function uploadFile(UploadedFile $file)
    {
        $file->saveAs(Yii::getAlias('@web') . 'uploads/' . $file->name);
        return $file->name;
    }
}
