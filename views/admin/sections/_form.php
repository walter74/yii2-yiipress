<?php 
use \yii\helpers\Url;

$js=<<<STR


 tinymce.init({
    selector: "#form-content",
    relative_urls : false,
    allow_script_urls: true,
    convert_urls: false,
    
    plugins: [
          "advlist autolink lists link charmap print preview anchor",
         "searchreplace visualblocks code fullscreen",
           "insertdatetime image media table contextmenu paste ",
                                                               
    ],
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    extended_valid_elements:"iframe|src|width|height|name|align]",
    forced_root_block : "",
    verify_html : false,
    file_browser_callback: function(field_name, url, type, win) {
       if(type=='image'){
                 var cmsURL       = '{{placeholder_link_img}}';     // your URL could look like "/scripts/my_file_browser.php"
                 var searchString = window.location.search; // possible parameters

                  if (searchString.length < 1) {

                                                   searchString = "?";

                                                 }
                                             
              tinyMCE.activeEditor.windowManager.open({

                   file            : cmsURL,

                   title           : 'File Browser',

                   width           : 840,  // Your dimensions may differ - toy around with them!

                   height          : 800,

                   resizable       : "yes",

                   inline          : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!

           close_previous          : "no"

              }, {

                           window  : win,

                           input   : field_name

                 });
                    // win.document.getElementById(field_name).value = 'my browser value';
            }
       if(type=='media'){
                 var cmsURL       = '{{placeholder_link_media}}';     // your URL could look like "/scripts/my_file_browser.php"
                 var searchString = window.location.search; // possible parameters

                  if (searchString.length < 1) {

                                                   searchString = "?";

                                                 }
                                             
              tinyMCE.activeEditor.windowManager.open({

                   file            : cmsURL,

                   title           : 'File Browser',

                   width           : 840,  // Your dimensions may differ - toy around with them!

                   height          : 800,

                   resizable       : "yes",

                   inline          : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!

           close_previous          : "no"

              }, {

                           window  : win,

                           input   : field_name

                 });
                    // win.document.getElementById(field_name).value = 'my browser value';
            }
         
       if(type=='file'){
                 var cmsURL       = '{{placeholder_link_file}}';     // your URL could look like "/scripts/my_file_browser.php"
                 var searchString = window.location.search; // possible parameters

                  if (searchString.length < 1) {

                                                   searchString = "?";

                                                 }
                                             
              tinyMCE.activeEditor.windowManager.open({

                   file            : cmsURL,

                   title           : 'File Browser',

                   width           : 840,  // Your dimensions may differ - toy around with them!

                   height          : 800,

                   resizable       : "yes",

                   inline          : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!

           close_previous          : "no"

              }, {

                           window  : win,

                           input   : field_name

                 });
                    // win.document.getElementById(field_name).value = 'my browser value';
            }
      }
});   
    
STR;


$js=str_replace('{{placeholder_link_img}}',Url::to(['admin/file-browser']),$js);
$js=str_replace('{{placeholder_link_media}}',Url::to(['admin/file-browser','type'=>'media']),$js);
$js=str_replace('{{placeholder_link_file}}',Url::to(['admin/file-browser','type'=>'file']),$js);




$content= \yii\helpers\HtmlPurifier::process($model->content, function ($config) {
	
	  $config->set('HTML.SafeIframe', true);
	  $config->set('HTML.MaxImgLength',null);
	  $config->set('CSS.MaxImgLength',null);
	  
	 // $config->set('URI.AllowedSchemes', array('data' => true)); 
      $config->set('URI.SafeIframeRegexp', '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/|www\.google\.com/maps/embed)%'); //allow YouTube and Vimeo and google map
	  $config->getHTMLDefinition(true)->addAttribute('iframe', 'allowfullscreen', 'Bool');
	  $config->getHTMLDefinition(true)
			->addElement('video', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common', 
										array( 
											'src' => 'URI', 
											'type' => 'Text', 
											'width' => 'Length', 
											'height' => 'Length', 
											'poster' => 'URI', 
											'preload' => 'Enum#auto,metadata,none', 
											'controls' => 'Bool', 
											));
     $config->getHTMLDefinition(true)
			->addElement('source', 'Block', 'Flow', 'Common',
										array(
											'src' => 'URI',
											'type' => 'Text',
											));
   // $config->set('HTML.SafeIframe', true);
   // $config->set('URI.SafeIframeRegexp', '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%'); //allow YouTube and Vimeo
});
?>

<?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

	<?= $form->field($model, 'nome') ?>
	<?= $form->field($model, 'tag') ?>
	<?= $form->field($model, 'content')->widget(\walter74\yiipress\widgets\tinymcecms\TinyMce::className(), [
                              'options' => ['id'=>'form-content','rows' => 6,'z-index'=>'10','value'=>$content],
                              'language' => Yii::$app->language ,
                              'js'=>$js,
                             /* 'clientOptions' => [
                                                   'plugins' => [
                                                                "advlist autolink lists link charmap print preview anchor",
                                                                "searchreplace visualblocks code fullscreen",
                                                                "insertdatetime media table contextmenu paste"
                                                                ],
                                                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                                     'extended_valid_elements'=>  "iframe|src|width|height|name|align]",
                                                 ]*/
               ]);?>

    
<div class="form-group">
	<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
</div>
<?php \yii\bootstrap\ActiveForm::end(); ?>
