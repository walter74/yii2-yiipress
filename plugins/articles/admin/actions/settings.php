<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
$articles_settings_ns= '\plugins\articles\models\CmsArticlesSettingsForm';
$model = new $articles_settings_ns();

if(Yii::$app->request->post('CmsArticlesSettingsForm')){
			//var_dump(Yii::$app->request->post());
			//echo __DIR__ .'/../settings2.php';
			//validiamo i campi
			//var_dump(Yii::$app->request->post());
			if($model->load(Yii::$app->request->post())&&$model->validate()){
				 $json=json_encode(Yii::$app->request->post('CmsArticlesSettingsForm'));
				// var_dump(json_decode($json));
				if(file_put_contents(__DIR__ .'/../settings.json',$json)!==false){
					Yii::$app->session->setFlash('success',Yii::t('app','Le nuove impostazioni sono state salvate correttamente!'));
			    //Riaggiorniamo per permettere al plugin di settare le nuove impostazioni e visualizzarele sui campi del form
					//return Yii::$app->controller->refresh();
				}
				else
					Yii::$app->session->setFlash('error',Yii::t('app','Errore!Le nuove impostazioni non sono state salvate!'));
			}
			else{
			   Yii::$app->session->setFlash('error',Yii::t('app','Errore!'.json_encode($model->errors)));
			  // var_dump($model->errors);
			}
		
		}





$this->title="Impostazioni  Plugin \"Articles\"";
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
            //'url' => ['admin/menu', 'action' => 'list'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];


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
						<?php if(is_array(Yii::$app->controller->module->params['settings']['articles'])):?>
                             <?php $form = \yii\bootstrap\ActiveForm::begin();?>

										<?php foreach(Yii::$app->controller->module->params['settings']['articles'] as $key => $value):?>
											<div class="form-group">
												<label class="col-sm-2 control-label"><?=$key?></label>
												<div class="col-sm-10">
													<?= $form->field($model, $key,['inputOptions'=>['value'=>Yii::$app->controller->module->params['settings']['articles'][$key]]])->label(false) ?>
                                        
												</div>
											</div>

											<?php 
										endforeach;?>
											
							 	<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
                              
							
							<?php \yii\bootstrap\ActiveForm::end();?>
						<?php 
                        endif;?>
                         </div>
      

     </section>

</div>

























