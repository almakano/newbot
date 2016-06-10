<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $name;
?>
<h1>Медиафайлы</h1>
<?php
	$form = ActiveForm::begin([
		'options' => [
			'enctype' => 'multipart/form-data'
		],
		'action' => '?r=medias/upload',
	]);
?>
	<label class="btn btn-default">
		<span style="display: none;">
			<?= $form->field($modelUpload, 'files[]')->fileInput([
				'onchange' => 'this.form.submit();',
				'multiple' => true, 'accept' => 'image/*'
			]) ?>
		</span>
		<i class="fa fa-upload"></i> Загрузить
	</label>
<?php ActiveForm::end() ?>

<div class="medias-list">
	<div class="form-group"></div>
	<div class="row">
		<?php if(!empty($items)) foreach ($items as $i) { ?>
		<div class="col-xs-3 col-sm-6">
			<div class="item crop form-group">
				<img src="<?php echo $i['url']; ?>" alt="" class="img">
				<?php $form = ActiveForm::begin(['action' => '?r=medias/remove']); ?>
					<?= $form->field($modelRemove, 'id',
						['options' => ['class' => '']])
						->hiddenInput(['value' => $i->id])
						->label(false); 
					?>
					<button class="btn btn-danger" title="Удалить">
						<i class="fa fa-remove"></i>
					</button>
				<?php ActiveForm::end() ?>
				<a class="btn btn-default" data-toggle="modal" href="#modal-medias-edit-<?php echo $i->id; ?>" title="Изменить">
					<i class="fa fa-edit"></i>
				</a>
				<div class="modal fade" id="modal-medias-edit-<?php echo $i->id; ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<?php $form = ActiveForm::begin(['action' => '?r=medias/edit']); ?>
							<div class="modal-header">
								<h4 class="modal-title">Изменение медиафайла</h4>
							</div>
							<div class="modal-body">
								<?= $form->field($modelEdit, 'id',
									['options' => ['class' => '']])
									->hiddenInput(['value' => $i->id])
									->label(false); 
								?>
								<?= $form->field($modelEdit, 'url')->textInput(['value' => $i->url]); ?>
								<?= $form->field($modelEdit, 'desc')->textArea(['value' => $i->desc]); ?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
								<button class="btn btn-primary">Сохранить</button>
							</div>
							<?php ActiveForm::end() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } else { ?>
		<div class="col-xs-12">
			Добавьте медиафайлы 
		</div>
		<?php } ?>
	</div>
</div>