<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CmsPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cms Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cms Pages'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'slug',
            'created_at',
            'updated_at',
            // 'status',
            // 'layout',
            // 'view',

            [ 
              'class' => 'yii\grid\ActionColumn',
              'urlCreator'=>function ($action, $model, $key, $index, $this) {
				             return \yii\helpers\Url::to(['admin/page','slug'=>$model->slug,'action'=>$action]);
                        //return string;
                         },

            
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
