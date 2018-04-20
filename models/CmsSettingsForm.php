<?php
namespace walter74\yiipress\models;

use app\models\User;

use yii\base\Model;
use Yii;

/**
 * Settings form
 */
class CmsSettingsForm extends Model
{
    const STATUS_PUBLISHED=10;
    const STATUS_INACTIVE=0;
    const STATUS_MAINTENANCE=20;
    
    public $maintenanceLayout;
    public $sitemapControllers;
    public $controllerNamespace;
    public $modelNamespace;
    public $actionNamespace;
    public $assetNamespace;
    public $widgetNamespace;
    public $admin_layout;
    public $plugin_dir;
    public $theme_dir;
    public $theme;
    public $upload_url;
    public $upload_dir;
    public $template_layout_dir;
    public $template_views_dir;
    public $home_page;
    public $logout;
    public $status;
    /**
     * @inheritdoc
     */
    
   
    public function rules()
    {
        return [
            ['status','in','range'=>[self::STATUS_INACTIVE,self::STATUS_PUBLISHED,self::STATUS_MAINTENANCE]],
            [['controllerNamespace', 'modelNamespace', 'actionNamespace','assetNamespace','widgetNamespace'],'isNameSpace'],
            [['template_layout_dir','template_views_dir','upload_dir','plugin_dir','theme_dir'],'isDir'],
            [['home_page','logout','admin_layout','theme'],'string'],
            ['maintenanceLayout','isFileExist'],
            ['sitemapControllers', 'filter', 'filter' => function ($value) {
																				return explode(',',$value);
																			}],
            ['sitemapControllers','each', 'rule' => ['isClass']], 
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
