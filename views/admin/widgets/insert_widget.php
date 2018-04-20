<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmswidget */
/* @var $form ActiveForm */

/* @var $this yii\web\View */

$this->title="Aggiungi Widget";

$this->params['breadcrumbs'][]=[
            'label' => 'Widgets',
            'url' => ['admin/widgets'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => 'Aggiungi Widget',
           
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
<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Aggiungi Widget
                          </header>
                          <div class="panel-body">
                             <div class="form">
                                  
								<div class="admin-aggiungi_widget">
                                <?= $this->render('_form',['model'=>$model])?>
								

								</div><!-- admin-create_widget -->

							</div>

                          </div>
                      </section>
               </div>
</div>
</div>
