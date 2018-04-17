<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmssections */
/* @var $form ActiveForm */
?>
<?php
/* @var $this yii\web\View */

$this->title="Crea Sezione";

$this->params['breadcrumbs'][]=[
            'label' => 'Sezioni',
            'url' => ['admin/sections'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Crea Sezione',
           
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
                              Crea Sezioni
                          </header>
                          <div class="panel-body">
                             <div class="form">
                                  
								<div class="admin-create_sections">
									
                                 <?= $this->render('_form',['model'=>$model])?>
								

								</div><!-- admin-create_sections -->

							</div>

                          </div>
                      </section>
 </div>

