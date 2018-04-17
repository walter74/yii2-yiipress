<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\Cmsviews */
/* @var $form ActiveForm */

/* @var $this yii\web\View */
//$file=$model[0]['file'];
$model=(is_null($model))?['file'=>'','type'=>'','updated_at'=>'']:$model;
$this->title="View :".basename($model['file']);

$this->params['breadcrumbs'][]=[
            'label' => 'Views',
            'url' => ['admin/views'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
$this->params['breadcrumbs'][]=[
            'label' => $this->title,
           
            'template' => "<li><i class='fa fa-eye'> <b>{link}</b></i></li>\n", // template for this link only 
        ];
?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-eye"></i> <?=\yii\helpers\Html::encode($this->title)?></h3>
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
<p>
        <?= Html::a(Yii::t('app', '<i class="fa fa-list"></i> Assets'), ['admin/view','file'=>urlencode($model['file']),'action'=>'assets'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', '<i class="fa fa-list"></i> Menu'), ['admin/view','file'=>urlencode($model['file']),'action'=>'menu'], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app', '<i class="fa fa-list"></i> Widgets'), ['admin/view','file'=>urlencode($model['file']),'action'=>'widgets'], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app', '<i class="fa fa-list"></i> Sezioni/Blocchi'), ['admin/view','file'=>urlencode($model['file']),'action'=>'sections'], ['class' => 'btn btn-default']) ?>
   
</p>
<div class="col-lg-12">
	<div class="row">
                  
                      <section class="panel">
                          <header class="panel-heading">
                               <?= Html::encode($this->title) ?>
                          </header>
                          <div class="panel-body">
                             
                                  
								<div class="cms-views-view">

 

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'file',
            'type',
            
             'updated_at:date',
        ],
    ]) ?>

                                </div>

                            </div>
							

                         
                    </section>
        </div>

</div>
