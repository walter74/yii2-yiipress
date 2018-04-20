<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmssections */
/* @var $form ActiveForm */

/* @var $this yii\web\View */

$this->title="Sezione #".$model->id;

$this->params['breadcrumbs'][]=[
            'label' => 'Sezioni',
            'url' => ['admin/sections'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
           
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-eye"></i> <?=$this->title?></h3>
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
        <?= Html::a('<i class="fa fa-pencil"></i> '.Yii::t('app', 'Aggiorna'), ['admin/section','id' => $model->id,'action'=>'update'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-list"></i> '.Yii::t('app', 'Sub Sezioni'), ['admin/section','id' => $model->id,'action'=>'sub-sections'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-list"></i> '.Yii::t('app', 'Widgets'), ['admin/section','id' => $model->id,'action'=>'widgets'], ['class' => 'btn btn-default']) ?>
		<?= Html::a('<i class="fa fa-list"></i> '.Yii::t('app', 'Menu'), ['admin/section','id' => $model->id,'action'=>'menu'], ['class' => 'btn btn-info']) ?>
      
</div>
<div class="col-lg-12">

                 
                      <section class="panel">
                         
                          <div class="panel-body">
                             
                                  
								<div class="cms-sections-view">

  

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'tag',
		     [
		      'label'=>'Content',
		      'value'=>((strlen($model->content)>50)?substr($model->content,0,50).'...':$model->content),
																	  
		     ],
            //'content:ntext',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

								</div>


							

                          </div>
                      </section>
             

</div>
