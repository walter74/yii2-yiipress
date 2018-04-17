<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \plugins\mailinglist\models\CmsMailinglist;


/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmssections */
/* @var $form ActiveForm */


$id=Yii::$app->request->get('id');
$model_mailinglist = CmsMailinglist::findOne($id);
 

if ($model_mailinglist->load(Yii::$app->request->post())) {
			
					
					
					if ($model_mailinglist->save()) {
								Yii::$app->session->setFlash('success','l\'email è stata aggiornata correttamente');
					}
					else
						Yii::$app->session->setFlash('error','Errore aggiornamento email!');
}

			
	
?>
<?php
/* @var $this yii\web\View */

$this->title='Aggiorna Email #'.$model_mailinglist->id.' '.$model_mailinglist->email;

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
					<h3 class="page-header"><i class="fa fa-plus"></i> Aggiorna Email</h3>
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
                              Aggiorna Email
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
