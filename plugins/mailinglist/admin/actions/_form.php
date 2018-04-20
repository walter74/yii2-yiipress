<?php 
use \yii\helpers\Url;



?>

<?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

	
	<?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'description')->textarea() ?>
												
<div class="form-group">
	<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
</div>
<?php \yii\bootstrap\ActiveForm::end(); ?>
