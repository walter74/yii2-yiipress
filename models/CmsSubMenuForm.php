<?php
namespace walter74\yiipress\models;

use Yii;
use yii\base\Model;


class CmsSubMenuForm extends Model
{
    /**
     * @var UploadedFile
     */
    
  
    public $submenu;
    
    public function rules()
    {
        return [
            [['submenu'], 'string'],
           
            
        ];
    }
    
    
}
