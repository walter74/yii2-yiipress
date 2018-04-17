<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$className=$this->className();
/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\CmsAssets */
/* @var $form yii\widgets\ActiveForm */
$nm_model_assets=Yii::$app->controller->module->modelNamespace.'\CmsAssets';
$this->title="Aggiungi Asset";
$this->params['breadcrumbs'][]=[
            'label' => 'Pagine',
            'url' => ['admin/pages', 'action' => 'list'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Pagina #'.$model->id.' '.$model->title,
            'url' => ['admin/page', 'id' => $model->id],
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ]; 
$this->params['breadcrumbs'][]=[
            'label' => 'Assets',
            'url' => ['admin/page', 'id' => $model->id, 'action' => 'assets'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];  
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
           
            'template' => "<li><i class='fa fa-plus'> <b>{link}</b></i></li>\n", // template for this link only 
        ];     
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-plus"></i> <?=$this->title?></h3>
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
