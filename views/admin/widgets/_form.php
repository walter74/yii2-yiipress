<?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

			<?= $form->field($model, 'classname') ?>
			<?= $form->field($model, 'tag') ?>
            <?= $form->field($model, 'args')->label("Args(json doc)")->textarea(['value'=>$model->str_replacement_widget_link($model->args)]) ?>
    
			<div class="form-group">
					<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
			</div>
<?php \yii\bootstrap\ActiveForm::end(); ?>
