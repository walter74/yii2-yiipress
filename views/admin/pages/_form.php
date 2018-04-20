<?php
             $generic_form_nm=Yii::$app->controller->module->modelNamespace.'\CmsGenericFieldForm';
             $generic_form_model= new $generic_form_nm();
             $nm_model=Yii::$app->controller->module->modelNamespace.'\CmsPages';
?>                   
                               
								<?php $form = \yii\bootstrap\ActiveForm::begin([
																				'options' => ['enctype'=>'multipart/form-data']
																				]); ?>

								<?= $form->field($model, 'title') ?>
								<?= $form->field($model, 'title_alt') ?>
								<?= $form->field($model, 'slug') ?>
                                <?= $form->field($model, 'description')->textarea() ?>
                                <?= $form->field($generic_form_model, 'image')->widget(\kartik\file\FileInput::classname(), [
                                                                                                                             'name' => 'cover',
																															'pluginOptions'=>[
																																 'initialPreview'=>($model->img!='')?[\yii\helpers\Html::img($model->img,['class'=>'file-preview-image img-responsive', 'alt'=>'Cover Image', 'title'=>'Cover Image'])]:[],
                                                                          // Html::img(Yii::$app->urlManagerFrontEnd->createAbsoluteUrl(['site/showimg','id'=>$project->id,'field'=>'logo','v'=>$project->updated_at]), ['class'=>'file-preview-image', 'alt'=>'The Moon', 'title'=>'The Moon']),
            //Html::img("/images/earth.jpg",  ['class'=>'file-preview-image', 'alt'=>'The Earth', 'title'=>'The Earth']),
                                                                                       // ],
																															'initialCaption'=>"Img",
																															'overwriteInitial'=>true,
																															'showCaption' => false,
																															'showRemove' => false,
																															'showUpload' => false,
																															'browseClass' => 'btn btn-primary',
																															'browseIcon' => '<i class="fa fa-camera"></i> ',
																															'browseLabel' =>  'Select Cover'
																															],
																															'options' => ['accept' => 'image/*'],
																												]);?>
								<?= $form->field($model, 'status')->dropDownList(
																					[$nm_model::STATUS_PUBLISHED=>'Pubblica', $nm_model::STATUS_INACTIVE=>'Inattiva'],          // Flat array ('id'=>'label')
																					[$nm_model::STATUS_PUBLISHED=>'Pubblica']    // options
																				);?>
								<?= $form->field($model, 'theme') ?>
								<?= $form->field($model, 'layout') ?>
								<?= $form->field($model, 'view') ?>
    
									<div class="form-group">
									<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
									</div>
								<?php \yii\bootstrap\ActiveForm::end(); ?>
