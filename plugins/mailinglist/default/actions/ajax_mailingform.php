<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \plugins\mailinglist\models\CmsMailinglist;

use yii\web\UploadedFile;
/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmssections */
/* @var $form ActiveForm */

$model= new CmsMailinglist();
 if(Yii::$app->request->isAjax){
		 
				  // $model->load(Yii::$app->request->post())
					
			if(Yii::$app->request->post('mailinglist_email')){
					
					$model->email = Yii::$app->request->post('mailinglist_email');
					$model->description= urldecode(Yii::$app->request->post('description'));
					if ($model->save()) {
						 echo "<span style='background-color:green;color:white'>l'email è stata aggiunta alla lista</span>";
								
								
								
								
					}
					else{
						 $errors=implode(';',$model->errors['email']);
						 echo "<span style='background-color:red;color:white'>Errore! Email non aggiunta! ".$errors."</span>";
						 
						 
				   }	
			
			}
	  
	  }
