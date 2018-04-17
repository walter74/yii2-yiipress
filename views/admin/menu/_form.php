<?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

			<?= $form->field($model, 'name') ?>
			<?= $form->field($model, 'classname')?>
			<?= $form->field($model, 'tag') ?>
            <?= $form->field($model, 'config')->label('Config(json doc)')->textarea(['value'=>str_replace('\\\\','\\',$model->config)]) ?>
    
			<div class="form-group">
					<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
			</div>
<?php \yii\bootstrap\ActiveForm::end(); ?>
