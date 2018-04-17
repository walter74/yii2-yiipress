<?php

namespace plugins\mailinglist\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * CmsArticlesSearch represents the model behind the search form of `app\modules\cms\models\CmsArticles`.
 */
class CmsMailinglist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_mailing_list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'unique'],
            [['description'], 'string'],
            [['email'], 'email'],
          
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
           
            'description' => Yii::t('app', 'Description'),
            'email' => Yii::t('app', 'Email'),
           
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        
        ];
    }
    public function afterSave ($insert,$changedAttributes){
		parent::afterSave($insert, $changedAttributes);
		
		if($insert===true){
			if(is_object(Yii::$app->mailer)){
				Yii::$app->mailer->compose()
					->setTo(Yii::$app->params['webcoderEmail'])
					->setFrom([$this->email => $this->email])
					->setSubject("Mailinglist")
					->setTextBody($this->description)
					->send();
			}
	    }
    
    }
    /**
     * @inheritdoc
     * @return CmsArticlesQuery the active query used by this AR class.
     */
    public function behaviors()
	{
		return [
				\yii\behaviors\TimestampBehavior::className(),
				
				];
	}
    
    public static function find()
    {
        return new CmsMailinglistQuery(get_called_class());
    }

   
    
}
