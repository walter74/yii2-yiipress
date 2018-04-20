<?php
namespace walter74\yiipress\models;

use Yii;
use yii\base\Model;


class CmsLinkForm extends Model
{
    /**
     * @var UploadedFile
     */
    
    public $label;
    public $url;
    
    public function rules()
    {
        return [
            [['url'], 'url'],
            [['label'], 'string']
            
        ];
    }
    
    
}
