<?php
use \plugins\articles\models\CmsArticles;
/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmssections */
/* @var $form ActiveForm */
$id=Yii::$app->request->get('id');
$model_article = CmsArticles::findOne($id);
if(is_object($model_article))
     $model_article->delete();
     
return Yii::$app->controller->redirect(['admin/run','plugin_name'=>'articles','action'=>'elenca']);
