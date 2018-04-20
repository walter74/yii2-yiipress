<?php 
use yii\helpers\Html;

$nm_popup_tinymce=Yii::$app->controller->module->widgetNamespace.'\tinymcecms\TinyMcePopupAsset';
$nm_admin_asset=Yii::$app->controller->module->assetNamespace.'\AdminAsset';
$nm_popup_tinymce::register($this);
$nm_admin_asset::register($this);
?>
<?php Yii::$app->view->beginPage();

if($type=='image'){
$js=<<<STR
 $('.bizcontent').click(function(event){

              var selectedImage   = $(this).find('img').attr('src');
             // $(this).find('input').prop('checked', true);
 
              var win             = tinyMCEPopup.getWindowArg("window");

              var dialogueBoxObject   = win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = selectedImage;

});
STR;
$this->registerJs($js,\yii\web\View::POS_END);
}
if($type=='file'){
$js=<<<STR
 $('.bizcontent').click(function(event){

              var selectedFile   = $(this).find('input').val();
             // $(this).find('input').prop('checked', true);
 
              var win             = tinyMCEPopup.getWindowArg("window");

              var dialogueBoxObject   = win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = selectedFile;

});
STR;
$this->registerJs($js,\yii\web\View::POS_END);
}
if($type=='media'){
$js=<<<STR
 $('.bizcontent').click(function(event){

              var selectedImage   = $(this).find('img').attr('src');
             // $(this).find('input').prop('checked', true);
 
              var win             = tinyMCEPopup.getWindowArg("window");

              var dialogueBoxObject   = win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = selectedImage;

});
STR;
$this->registerJs($js,\yii\web\View::POS_END);
}
$css=<<<str
.searchable-container{margin:20px 0 0 0}
.searchable-container label.btn-default.active{background-color:#007ba7;color:#FFF}
.searchable-container label.btn-default{width:90%;border:1px solid #efefef;margin:5px; box-shadow:5px 8px 8px 0 #ccc;}
.searchable-container label .bizcontent{width:100%;}
.searchable-container .btn-group{width:90%}
.searchable-container .btn span.glyphicon{
    opacity: 0;
}
.searchable-container .btn.active span.glyphicon {
    opacity: 1;
}

str;
$this->registerCss($css);
?>
<html>
<head>
  
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>   <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="Yii-Press">
     <link rel="shortcut icon" href="img/favicon.png">
   <!-- <link href="/home/devplatf/public_html/main/basic/web/assets/44453ab2/css/bootstrap.css" rel="stylesheet">
<link href="/home/devplatf/public_html/main/basic/web/css/site.css" rel="stylesheet">
<link href="/home/devplatf/public_html/main/basic/web/assets/b71a6247/css/bootstrap.min.css" rel="stylesheet">
<link href="/home/devplatf/public_html/main/basic/web/assets/b71a6247/css/bootstrap-theme.css" rel="stylesheet">
<link href="/home/devplatf/public_html/main/basic/web/assets/b71a6247/css/elegant-icons-style.css" rel="stylesheet">
<link href="/home/devplatf/public_html/main/basic/web/assets/b71a6247/css/font-awesome.min.css" rel="stylesheet">
<link href="/home/devplatf/public_html/main/basic/web/assets/b71a6247/css/style.css" rel="stylesheet">
<link href="/home/devplatf/public_html/main/basic/web/assets/b71a6247/css/style-responsive.css" rel="stylesheet">-->
<?php Yii::$app->view->head();?>
<script style="display: none;">var tvt = tvt || {}; tvt.captureVariables = function (a){for(var b=new Date,c={},d=Object.keys(a||{}),e=0,
f;f=d[e];e++)if(a.hasOwnProperty(f)&&"undefined"!=typeof a[f])try{var g=[];c[f]=JSON.stringify(a[f],function(a,b){try{if("function"!==typeof b){if("object"===typeof b&&null!==b){if(b instanceof HTMLElement||b instanceof Node||-1!=g.indexOf(b))return;g.push(b)}return b}}catch(L){}})}catch(l){}a=document.createEvent("CustomEvent");a.initCustomEvent("TvtRetrievedVariablesEvent",!0,!0,{variables:c,date:b});window.dispatchEvent(a)};window.setTimeout(function() {tvt.captureVariables({'dataLayer': window['dataLayer']})}, 2000);</script><style id="__web-inspector-hide-shortcut-style__" type="text/css">
.__web-inspector-hide-shortcut__, .__web-inspector-hide-shortcut__ *, .__web-inspector-hidebefore-shortcut__::before, .__web-inspector-hideafter-shortcut__::after
{
    visibility: hidden !important;
}
</style>
</head>
<body>
	<?php Yii::$app->view->beginBody();?>
<?php
/* @var $this yii\web\View */



$this->params['breadcrumbs'][]=[
            'label' => 'Media',
           // 'url' => ['admin/media'],
            'template' => "<li><i class='fa fa-list'> <b>{link}</b></i></li>\n", // template for this link only 
        ];

?>
<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-list"></i> File Browser</h3>
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
	<div class="searchable-container">
	 <?php foreach($list_files as $key=>$value):?>
	         
                <div class="items col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="info-block block-info clearfix">
                       
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5><?= (strlen($value['nome'])>10)?substr($value['nome'].'...',0,10):$value['nome']?> </h5>
                                    
                               
	     <?php if(strpos($value['tipo'], 'image')!==false): 
	     
	    // $image_base64=base64_encode(file_get_contents(Yii::getAlias(Yii::$app->controller->module->upload_dir.'/'.$value['nome'])));
	     //var_dump($image_base64);
	     ?>
	                    <input type="radio" name="media" value="<?=Yii::getAlias(Yii::$app->controller->module->upload_dir.'/'.$value['nome'])?>">
	                    <img alt="image" class="img-responsive" src="<?=Yii::getAlias(Yii::$app->controller->module->upload_dir.'/'.$value['nome'])?>">
						
	     <?php endif;?> 
	     <?php if(strpos($value['tipo'], 'pdf')!==false||strpos($value['tipo'], 'doc')!==false||strpos($value['tipo'], 'mp4')!==false): ?>     
	   
					    <div class="icon"> 
						   <i class="fa fa-file"></i>
						  <input type="hidden" value="<?=Yii::getAlias(Yii::$app->controller->module->upload_dir.'/'.$value['nome'])?>">
						</div>
						 
				 
	     <?php endif;?> 
	 	
			
								</div>
                            </label>
                        </div>
                    </div>
                </div>
           
           
	<?php endforeach;?>	
	 </div>	
</div>



<?php Yii::$app->view->endBody();?>
</body>
</html>
<?php Yii::$app->view->endPage();?>
