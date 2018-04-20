<?php
use yii\helpers\Url;
use yii\widgets\ListView;

?>
<div class="row">
			
			
<?php
echo ListView::widget([
    // 'id' => 'all-news-id',
     'dataProvider' => $dataProvider,
     
     'layout'=>'{items}{pager}',
    
     'itemView' => ($dataProvider->count>0)?function ($model, $key, $index, $widget)use($content_view,$slug,$slug_articles,$plugin_name){
		       echo $this->render(($content_view)?\Yii::getAlias($content_view):'_content_view',['model'=>$model,'key'=>$key,'index'=>$index,'widget'=>$widget,'slug'=>$slug,'slug_articles'=>$slug_articles,'edit_permission'=>$edit_permission,'plugin_name'=>$plugin_name]);
		 
		 }:'',
   
   
]);


?>
	<div class="clearfix"></div>
</div>
