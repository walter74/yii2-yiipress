<?php
/* @var $this yii\web\View */
$this->params['breadcrumbs'][]="Impostazioni Generali";
$this->title="Impostazioni Generali";
$cn_settings_form=get_class($model);

?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-wrench"></i> <?=$this->title ?></h3>
					<div class="pull-right"></div>
					<?= \yii\widgets\Breadcrumbs::widget([
												'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
											]);?>
					
</div>


<div class="col-lg-12">

	<section class="panel">
                          <header class="panel-heading">
                            Impostazioni Generali
                          </header>
                          <div class="panel-body">
                             <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Controllers NameSpace</label>
                                      <div class="col-sm-10">
										  <?= $form->field($model, 'controllerNamespace',['inputOptions'=>['value'=>Yii::$app->controller->module->controllerNamespace]])->label(false) ?>
                                        <!--  <input type="text" name="Settings[controllerNamespace]" class="form-control" value="">
                                       -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">userModel</label>
                                      <div class="col-sm-10">
										  <?= $form->field($model, 'userModel',['inputOptions'=>['value'=>Yii::$app->controller->module->userModel]])->label(false) ?>
                                        <!--  <input type="text" name="Settings[controllerNamespace]" class="form-control" value="">
                                       -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Models NameSpace</label>
                                      <div class="col-sm-10">
                                           <?= $form->field($model, 'modelNamespace',['inputOptions'=>['value'=>Yii::$app->controller->module->modelNamespace]])->label(false) ?>
                                       
                                       <!--   <input type="text" name="Settings[modelNamespace]" class="form-control" value="">
                                      -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Actions NameSpace</label>
                                      <div class="col-sm-10">
                                           <?= $form->field($model, 'actionNamespace',['inputOptions'=>['value'=>Yii::$app->controller->module->actionNamespace]])->label(false) ?>
                                       
                                       <!--   <input type="text" name="Settings[actionNamespace]" class="form-control" value="">
                                      -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Assets NameSpace</label>
                                      <div class="col-sm-10">
										    <?= $form->field($model, 'assetNamespace',['inputOptions'=>['value'=>Yii::$app->controller->module->assetNamespace]])->label(false) ?>
                                       
                                         <!-- <input type="text" name="Settings[assetNamespace]" class="form-control" value="">
                                        -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Widgets NameSpace</label>
                                      <div class="col-sm-10">
										    <?= $form->field($model, 'widgetNamespace',['inputOptions'=>['value'=>Yii::$app->controller->module->widgetNamespace]])->label(false) ?>
                                       
                                        <!--  <input type="text" name="Settings[widgetNamespace]" class="form-control" value="">
                                        -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Plugins Directory</label>
                                      <div class="col-sm-10">
										    <?= $form->field($model, 'plugin_dir',['inputOptions'=>['value'=>Yii::$app->controller->module->plugin_dir]])->label(false) ?>
                                       
                                        <!--  <input type="text" name="Settings[widgetNamespace]" class="form-control" value="">
                                        -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Themes Directory</label>
                                      <div class="col-sm-10">
										    <?= $form->field($model, 'theme_dir',['inputOptions'=>['value'=>Yii::$app->controller->module->theme_dir]])->label(false) ?>
                                       
                                        <!--  <input type="text" name="Settings[widgetNamespace]" class="form-control" value="">
                                        -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Upload Directory</label>
                                      <div class="col-sm-10">
										    <?= $form->field($model, 'upload_dir',['inputOptions'=>['value'=>Yii::$app->controller->module->upload_dir]])->label(false) ?>
                                       
                                         <!-- <input type="text" name="Settings[upload_dir]" class="form-control" value="">
                                      -->
                                      </div>
                                  </div>
                                   <div class="form-group">
                                      <label class="col-sm-2 control-label">Upload Url</label>
                                      <div class="col-sm-10">
										    <?= $form->field($model, 'upload_url',['inputOptions'=>['value'=>Yii::$app->controller->module->upload_url]])->label(false) ?>
                                       
                                         <!-- <input type="text" name="Settings[upload_dir]" class="form-control" value="">
                                      -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Theme</label>
                                      <div class="col-sm-10">
										    <?= $form->field($model, 'theme',['inputOptions'=>['value'=>Yii::$app->controller->module->theme]])->label(false) ?>
                                       
                                         <!-- <input type="text" name="Settings[template_layout_dir]" class="form-control" value="">
                                         -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Layouts Directory</label>
                                      <div class="col-sm-10">
										    <?= $form->field($model, 'template_layout_dir',['inputOptions'=>['value'=>Yii::$app->controller->module->template_layout_dir]])->label(false) ?>
                                       
                                         <!-- <input type="text" name="Settings[template_layout_dir]" class="form-control" value="">
                                         -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Views Directory</label>
                                      <div class="col-sm-10">
										    <?= $form->field($model, 'template_views_dir',['inputOptions'=>['value'=>Yii::$app->controller->module->template_views_dir]])->label(false) ?>
                                       
                                          <!--<input type="text" name="Settings[template_views_dir]" class="form-control" value="">
                                          -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Home Page</label>
                                      <div class="col-sm-10">
										    <?= $form->field($model, 'home_page',['inputOptions'=>['value'=>Yii::$app->controller->module->home_page]])->label(false) ?>
                                       
                                         <!-- <input type="text" name="Settings[home_page]" class="form-control" value="">
                                         -->
                                      </div>
                                  </div>
                                   <div class="form-group">
                                      <label class="col-sm-2 control-label">Logout Route</label>
                                      <div class="col-sm-10">
										    <?= $form->field($model, 'logout',['inputOptions'=>['value'=>Yii::$app->controller->module->logout]])->label(false) ?>
                                       
                                         <!-- <input type="text" name="Settings[logout]" class="form-control" value="">
                                         -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Status</label>
                                      <div class="col-sm-10">
										 <?= $form->field($model, 'status')->label(false)->dropDownList(
																					[$cn_settings_form::STATUS_PUBLISHED=>'Pubblica', $cn_settings_form::STATUS_INACTIVE=>'Inattiva',$cn_settings_form::STATUS_MAINTENANCE=>'Manutenzione'],          // Flat array ('id'=>'label')
																					['options' => [Yii::$app->controller->module->status => ['Selected'=>true]]]    // options
																				);?>
										  
										    
                                         <!-- <input type="text" name="Settings[logout]" class="form-control" value="">
                                         -->
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Maintenance Layout</label>
                                      <div class="col-sm-10">
										<?= $form->field($model, 'maintenanceLayout',['inputOptions'=>['value'=>Yii::$app->controller->module->maintenanceLayout]])->label(false) ?>
                                       
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Site Map Controllers</label>
                                      <div class="col-sm-10">
										<?= $form->field($model, 'sitemapControllers',['inputOptions'=>['value'=>is_array(Yii::$app->controller->module->sitemapControllers)?implode(',',Yii::$app->controller->module->sitemapControllers):Yii::$app->controller->module->sitemapControllers]])->label(false) ?>
                                       
                                      </div>
                                  </div>
                                  <!--
                                    <input id="form-token" type="hidden" name="" value=""/>
                                  -->
                                  	<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
                                 <!-- <input class="btn btn-success" type="submit" value="Salva">-->
                              <?php \yii\bootstrap\ActiveForm::end()?>
                          </div>
      </section>



</div>

