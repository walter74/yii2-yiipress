<?php

namespace walter74\yiipress\actions;

use Yii;
use yii\base\Action;
use yii\web\UploadedFile;

class FileUploadAction extends Action
{
   public function run($type='image'){
	    $upload_form_ns = $this->controller->module->modelNamespace.'\UploadForm';
	    $model = new $upload_form_ns();

        if (Yii::$app->request->isAjax) {
			if($type=='image'||!isset($type))
              $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if($type=='video')
              $model->videoFiles = UploadedFile::getInstances($model, 'videoFiles');
            if($type=='doc')
              $model->docFiles = UploadedFile::getInstances($model, 'docFiles');  
            if($type=='plugin'||$type=='view'||$type=='layout'||$type=='theme')
              $model->zipFiles = UploadedFile::getInstances($model, 'zipFiles');  
            //var_dump(Yii::$app->request->post());
            if ($model->upload($type)) {
                // file is uploaded successfully
                
                return json_encode([]);
            }
            else
            {
				$errors=$model->errors;
				
				
				
				if($type=='image'&&isset($errors['imageFiles']))$error=implode(";", $errors['imageFiles']);
             
                if($type=='video'&&isset($errors['videoFiles']))$error=implode(";", $errors['videoFiles']);
              
                if($type=='doc'&&isset($errors['docFiles']))$error=implode(";", $errors['docFiles']);
             
                if(($type=='plugin'||$type=='view'||$type=='layout'||$type=='theme')&&isset($errors['zipFiles']))$error=implode(";", $errors['zipFiles']);
				
				return json_encode(['error'=>$error]);
				
			}
         }

	   
	   }
}
