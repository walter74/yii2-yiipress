<?php
namespace plugins\articles\models;

use yii\base\Model;


class CmsKeywords extends Model
{
    /**
     * @var UploadedFile
     */
    public $keywords = [];

    public function rules()
    {
        return [
            // checks if every category ID is an integer
            ['keywords', 'each', 'rule' => ['string']],
        ];
    }
    
    
}
