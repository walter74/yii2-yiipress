<?php
use kartik\file\FileInput;
// or 'use kartikile\FileInput' if you have only installed yii2-widget-fileinput in isolation
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
// Ajax uploads with drag and drop feature. Enable AJAX uploads by setting the `uploadUrl` property 
// in pluginOptions. You can also pass extra data to your upload URL via `uploadExtraData`. Refer 
// [plugin documentation and demos](http://plugins.krajee.com/file-input/demo) for more details 
// and options on using AJAX uploads.
?>
<?php
/* @var $this yii\web\View */

$this->title="Carica Layout";

$this->params['breadcrumbs'][]=[
            'label' => 'Layouts',
            'url' => ['admin/layouts'],
            'template' => "<li><i class='fa fa-cogs-o'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
            //'url' => ['admin/menu', 'action' => 'list'],
            'template' => "<li><i class='fa fa-plus'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-list"></i> <?=$this->title?></h3>
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
<div style="background-color:white">
<?php $form = ActiveForm::begin([
     'id'=>'add_plugin',
    'options' => ['enctype' => 'multipart/form-data'],
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-1',
            'offset' => 'col-sm-offset-1',
            'wrapper' => 'col-sm-12',
            'error' => '',
            'hint' => '',
        ],
    ],
]);
?>
<?= $form->field($model,'zipFiles[]')->label('Plugin(zip format)')->widget(
     FileInput::classname(),[

     'options'=>[
               'id'=>'mediaform-plugin',
               'multiple'=>true,
               'accept' => '*',
         ],
    'pluginOptions' => [
        'uploadUrl' => Url::to(['admin/file-upload','type'=>'layout']),
        'uploadAsync'=> true,
        'uploadExtraData' => [
          
        ],
        'maxFileCount' => 10
    ]
]);
?>
<?php ActiveForm::end();?>
</div>
</div>
