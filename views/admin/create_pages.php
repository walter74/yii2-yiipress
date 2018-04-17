<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\CmsPages */
/* @var $form ActiveForm */
?>
<?php
/* @var $this yii\web\View */
//$nm_model=Yii::$app->controller->module->modelNamespace.'\CmsPages';
$this->title="Crea Pagina";

$this->params['breadcrumbs'][]=[
            'label' => 'Pagine',
            'url' => ['admin/pages'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Crea Pagina',
           
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
	
                  
                  <section class="panel">
                          <header class="panel-heading">
                              Crea Pagina
                          </header>
                          <div class="panel-body">
                             <div class="form">
                                  
								<div class="admin-create_pages"> 
                                <?= $this->render('pages/_form',['model'=>$model])?>
								
								</div><!-- admin-create_pages -->

							</div>

                          </div>
                  </section>
               
	
</div>
