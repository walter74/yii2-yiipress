<?php
namespace walter74\yiipress\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;
    public $zipFiles;
	public $docFiles;
	public $videoFiles;
	
    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,jpeg,gif,png,doc,pdf,txt,mp3,mp4', 'maxFiles' => 4],
            [['docFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc,pdf,txt', 'maxFiles' => 4],
            [['videoFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp3,mp4', 'maxFiles' => 4],
            [['zipFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'zip', 'maxFiles' => 4],
        ];
    }
    
    public function upload($type=null)
    {
        if ($this->validate()) { 
			if(isset($this->imageFiles))
			{
				foreach ($this->imageFiles as $file) {
					$file->saveAs(Yii::getAlias(Yii::$app->controller->module->upload_dir.'/'. $file->baseName . '.' . $file->extension));
				}
			}
			if(isset($this->videoFiles))
			{
				foreach ($this->imageFiles as $file) {
					$file->saveAs(Yii::getAlias(Yii::$app->controller->module->upload_dir.'/'. $file->baseName . '.' . $file->extension));
				}
			}
			if(isset($this->docFiles))
			{
				foreach ($this->imageFiles as $file) {
					$file->saveAs(Yii::getAlias(Yii::$app->controller->module->upload_dir.'/'. $file->baseName . '.' . $file->extension));
				}
			}
			if(isset($this->zipFiles))
			{
			   if($type=="plugin"){
					foreach ($this->zipFiles as $file) {
						$zip = new \ZipArchive;
						if ($zip->open($file->tempName) === TRUE) {
																	$zip->extractTo(Yii::getAlias(Yii::$app->controller->module->plugin_dir).'/'.str_replace('.zip','',$file->name).'/');
																	$zip->close();
																	
						} 
						
					}
			   }
			   if($type=="theme"){
					foreach ($this->zipFiles as $file) {
						$zip = new \ZipArchive;
						if ($zip->open($file->tempName) === TRUE) {
																	$zip->extractTo(Yii::getAlias(Yii::$app->controller->module->theme_dir).'/'.str_replace('.zip','',$file->name).'/');
																	$zip->close();
																	
						} 
						
					}
			   }
			   if($type=="view"){
					foreach ($this->zipFiles as $file) {
						$zip = new \ZipArchive;
						if ($zip->open($file->tempName) === TRUE) {
																	$zip->extractTo(Yii::getAlias(Yii::$app->controller->module->template_views_dir).'/');
																	$zip->close();
																	
						} 
						
					}
			   }
			   if($type=="layout"){
					foreach ($this->zipFiles as $file) {
						$zip = new \ZipArchive;
						if ($zip->open($file->tempName) === TRUE) {
																	$zip->extractTo(Yii::getAlias(Yii::$app->controller->module->template_layout_dir).'/');
																	$zip->close();
																	
						} 
						
					}
			   }
			}
            return true;
        } else {
            return false;
        }
    }
    
}
