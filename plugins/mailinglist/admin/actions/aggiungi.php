<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \plugins\mailinglist\models\CmsMailinglist;

use yii\web\UploadedFile;
/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmssections */
/* @var $form ActiveForm */

$model_mailinglist = new CmsMailinglist();
    

if($action=='aggiungi'){
			   

				if (!empty(Yii::$app->request->post('CmsMailinglist'))&&$model_mailinglist->load(Yii::$app->request->post())) {
				
					
					
					if ($model_mailinglist->save()) {
								Yii::$app->session->setFlash('success','l\'email è stata aggiunta alla lista');
								
								
					}
					else
						Yii::$app->session->setFlash('error','Errore! Email non aggiunta!'.json_encode($model_mailinglist->errors));
				}

			
		}
?>
<?php
/* @var $this yii\web\View */

$this->title='Aggiungi Email';

$this->params['breadcrumbs'][]=[
            'label' => 'Emails',
            'url' => ['admin/run','plugin_name'=>'mailinglist','action'=>'elenca'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
           
            'template' => "<li><i class='fa fa-plus'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-plus"></i> Aggiungi Email</h3>
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
                      <section class="panel">
                          <header class="panel-heading">
                              Aggiungi Email
                          </header>
                          <div class="panel-body">
                             <div class="form">
                                  
								<div class="admin-create_article">
									
                                 <?= $this->render('@plugins/mailinglist/admin/actions/_form',['model'=>$model_mailinglist])?>
								

								</div><!-- admin-create_sections -->

							</div>

                          </div>
                      </section>
 </div>
