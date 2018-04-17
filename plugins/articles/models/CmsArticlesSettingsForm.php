<?php
namespace plugins\articles\models;


use yii\base\Model;
use Yii;

/**
 * Settings form
 */
class CmsArticlesSettingsForm extends Model
{
   public $articles_page;
   public $article_page;
    /**
     * @inheritdoc
     */
    
   
    public function rules()
    {
        return [
          
            [['article_page','articles_page'],'string'],
           
          //  ['upload_url','url']
           
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function isNameSpace($attribute,$params)
	{
		$dir_namespace = str_replace('\\', '/', $this->$attribute);
		$dir_namespace=Yii::getAlias(trim('@'.$dir_namespace));
		
		if(!is_dir($dir_namespace)){ 
	       $this->addError($attribute, 'Non è un namespace corrispondente ad una directory esistente!');
	    }
	}
	public function isDir($attribute,$params)
	{
		$directory=Yii::getAlias($this->$attribute);
		if(!is_dir($directory)){
	       $this->addError($attribute, 'Non è una directory esistente... controlla il percorso!');
	    }
	}
    public function isFileExist($attribute,$params)
	{
		$file=Yii::getAlias($this->$attribute).'.php';
		if(!file_exists($file)){
	       $this->addError($attribute, 'Non è un file esistente... controlla il percorso!');
	    }
	}
	public function isClass($attribute,$params)
	{
		$classname=trim($this->$attribute);
		if(!class_exists($classname)){
	       $this->addError($attribute, 'Non è una classe esistente... controlla il percorso!');
	    }
	}
}
