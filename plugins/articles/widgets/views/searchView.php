<?php 

$form=\yii\bootstrap\ActiveForm::begin([
                                        "action"=>\yii\helpers\Url::to([((Yii::$app->controller->module->action_page_root!==null)?Yii::$app->controller->module->action_page_root:Yii::$app->controller->id.'/'.Yii::$app->controller->action->id),'slug'=>$slug]),
                                        "enableClientScript" => false,
                                        "method"=>"GET"
                                      ]);
?>                                     
 <?= $form->field($model, 'w',["inputOptions"=>["placeholder"=>"Cerca Articolo","class"=>"form-control","onchange"=>"this.form.submit()"]])->label(false) ?>
<?php
\yii\bootstrap\ActiveForm::end();

?>
