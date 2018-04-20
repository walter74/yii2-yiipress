<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace plugins\mailinglist\widgets;

use Yii;


class MailingListForm extends \yii\bootstrap\Widget
{
   public $plugin_name="mailinglist";
   public $ajax_mailingform="ajax_mailingform";
   public $main_view="view";
   public $description="offerta";
   public function run()
    {
      
      $reply="";
      $model= new \plugins\mailinglist\models\CmsMailinglist();
      $view= $this->getView();
     // Yii::$app->getRequest()->enableCsrfValidation = false;
     // $csrf_token=Yii::$app->request->getCsrfToken(true); 
     
      $current_url= \yii\helpers\Url::current();
      
       $url_ajax_action_plugin= \yii\helpers\Url::to([((Yii::$app->controller->module->action_run_root!==null)?Yii::$app->controller->module->action_run_root:Yii::$app->controller->id.'/run'),'plugin_name'=>$this->plugin_name,'action'=>$this->ajax_mailingform]);
        
$js=<<<sss
$('#mailinglist_button').click(function() {
  var butt_mailing = $(this);
  butt_mailing.html("<i class='fa fa-circle-o-notch fa-spin'></i>");
  var mailinglist_email = $(this).parent().find('input').val();
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  //var csrfToken = "{{csrf_token}}";
  $.post("{{url}}", {mailinglist_email: mailinglist_email,description: encodeURI('{{description}}'), _csrf : csrfToken}, function(data){
						$('#mailinglist_answer').html(data);
                         butt_mailing.html("<i class='fa fa-envelope-o' aria-hidden='true'></i>");
});
  


});	

sss;

/* $.post("{{url}}", {mailinglist_email: mailinglist_email}, function(data){
  alert( "Data Loaded: " + data );
} );*/
$js=str_replace("{{url}}",$url_ajax_action_plugin,$js);    
$js=str_replace("{{description}}",$this->description,$js);
//$js=str_replace("{{csrf_token}}",$csrf_token,$js);
      
      $view->registerJs($js);
      
      if(Yii::$app->request->isAjax){
		 
				  // $model->load(Yii::$app->request->post())
					
			if(Yii::$app->request->post('mailinglist_email')&&(Yii::$app->controller->n_ajax_call==0)){
					
					$model->email = Yii::$app->request->post('mailinglist_email');
					$model->description=$this->description;
					if ($model->save()) {
								Yii::$app->controller->ajax_answer="<span style='background-color:green;color:white'>l'email è stata aggiunta alla lista</span>";
								Yii::$app->controller->n_ajax_call++;
								return;
								
								
					}
					else{
						 $errors=implode(';',$model->errors['email']);
						 Yii::$app->controller->ajax_answer="<span style='background-color:red;color:white'>Errore! Email non aggiunta! ".$errors."</span>";
						 Yii::$app->controller->n_ajax_call++;
						 return;
				   }	
			
			}
	   return;
	  }
     
      return $this->render($this->main_view,["model"=>$model,"reply"=>$reply]);
      
    }
}
