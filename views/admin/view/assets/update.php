<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$className=$this->className();
/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\CmsAssets */
/* @var $form yii\widgets\ActiveForm */
$nm_model_assets=Yii::$app->controller->module->modelNamespace.'\CmsAssets';
$this->title="Aggiorna Asset/Source";
$this->params['breadcrumbs'][]=[
            'label' => 'Views',
            'url' => ['admin/views', 'action' => 'list'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'View #'.basename($model['file']),
            'url' => ['admin/view', 'file' => basename($model['file'])],
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ]; 
$this->params['breadcrumbs'][]=[
            'label' => 'Assets',
            'url' => ['admin/view', 'file' => basename($model['file']),'action'=>'assets'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];  
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
           
            'template' => "<li><i class='fa fa-plus'> <b>{link}</b></i></li>\n", // template for this link only 
        ];         
?>
<div class="col-lg-12">
					<h3 class="view-header"><i class="fa fa-plus"></i> <?=$this->title?></h3>
					<div class="pull-right"></div>
					<?= \yii\widgets\Breadcrumbs::widget([
															'homeLink'=>[
																			'label' => ' DashBoard',
																			'url' => ['admin/index'],
																			'template' => "<li><i class='fa fa-home'>{link}</i></li>\n", // template for this link only
																		],
															'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		 									            ]);?>
					
</div>
<div class="col-lg-12">
	<div class="cms-assets-form">

    <?= $this->render('_form',['model_assets'=>$model_assets]);?>

	</div>
</div>
