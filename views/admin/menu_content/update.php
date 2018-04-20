<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmsmenu */
/* @var $form ActiveForm */
?>
<?php
/* @var $this yii\web\View */

$this->title="Aggiorna Menu #".$model->id;

$this->params['breadcrumbs'][]=[
            'label' => 'Menu',
            'url' => ['admin/menu'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
           
            'template' => "<li><i class='fa fa-pencil'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-pencil"></i> <?=$this->title?></h3>
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
                              <?= \yii\helpers\Html::encode($this->title)?>
                          </header>
                          <div class="panel-body">
                             <div class="form">
                                  
								<div class="admin-update_menu">
                                <?= $this->render('../menu/_form',['model'=>$model])?>
								

								</div><!-- admin-create_menu -->

							</div>

                          </div>
                      </section>
   
</div>
