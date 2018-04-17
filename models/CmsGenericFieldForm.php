<?php
namespace walter74\yiipress\models;

use Yii;
use yii\base\Model;


class CmsGenericFieldForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $image;
    public $file;
    public $media;
    public $text;
    
    public function rules()
    {
        return [
            [['image'], 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg,jpeg,gif,png'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,jpeg,gif,png,txt,pdf,doc,mp3,mp4'],
            [['media'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp3,mp4'],
            [['text'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,txt,doc']
        ];
    }
    
    
}
