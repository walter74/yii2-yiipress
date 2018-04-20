<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$className=$this->className();
/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\CmsAssets */
/* @var $form yii\widgets\ActiveForm */
$nm_model_assets=Yii::$app->controller->module->modelNamespace.'\CmsAssets';
$this->title="Aggiungi Asset/Source";
$this->params['breadcrumbs'][]=[
            'label' => 'Layouts',
            'url' => ['admin/layouts', 'action' => 'list'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Layout #'.basename($model['file']),
            'url' => ['admin/layout', 'file' => urlencode($model['file'])],
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ]; 
$this->params['breadcrumbs'][]=[
            'label' => 'Assets',
            'url' => ['admin/layout', 'file' => urlencode($model['file']), 'action' => 'assets'],
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
<div class="cms-assets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model_assets, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model_assets, 'type')->textInput()->dropDownList(
            [$nm_model_assets::TYPE_CSS=>'CSS',$nm_model_assets::TYPE_CSS_CODE=>'CSS_CODE',$nm_model_assets::TYPE_JS=>'JS',$nm_model_assets::TYPE_SCRIPT=>'SCRIPT',$nm_model_assets::TYPE_METATAG=>'META-TAG',$nm_model_assets::TYPE_LINKTAG=>'TYPE_LINKTAG',$nm_model_assets::TYPE_ASSET=>'ASSET'],           // Flat array ('id'=>'label')
            [$nm_model_assets::TYPE_CSS=>'CSS']    // options
        ); ?>



		 		 

    <?= $form->field($model_assets, 'position')->textInput()->dropDownList(
            [$className::PH_BODY_BEGIN=>'PH_BODY_BEGIN',$className::PH_BODY_END=>'PH_BODY_END',$className::PH_HEAD=>'PH_HEAD',$className::POS_LOAD=>'POS_LOAD',$className::POS_END =>'POS_END',$className::POS_HEAD=>'POS_HEAD',$className::POS_BEGIN=>'POS_BEGIN',$className::POS_READY=>'POS_READY'],           // Flat array ('id'=>'label')
            [$className::POS_HEAD=>'POS_HEAD']    // options
        ); ?>
    <?= $form->field($model_assets, 'depends')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
