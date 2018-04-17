<?php
namespace plugins\articles\models;

use yii\base\Model;
use yii\web\UploadedFile;

class CmsUploadCover extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,gif'],
        ];
    }
    
    
}
