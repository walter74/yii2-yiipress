<?php
use \plugins\mailinglist\models\CmsMailinglist;
/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmssections */
/* @var $form ActiveForm */
$id=Yii::$app->request->get('id');
$model_mailinglist = CmsMailinglist::findOne($id);
if(is_object($model_mailinglist))
     $model_mailinglist->delete();
     
return Yii::$app->controller->redirect(['admin/run','plugin_name'=>'mailinglist','action'=>'elenca']);
