<?php
namespace plugins\articles\models;

use yii\base\Model;


class CmsTags extends Model
{
    /**
     * @var UploadedFile
     */
    public $tags = [];

    public function rules()
    {
        return [
            // checks if every category ID is an integer
            ['tags', 'each', 'rule' => ['string']],
        ];
    }
    
    
}
