<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use app\models\Medias;
use app\models\MediasUploadForm;
use app\models\MediasRemoveForm;
use app\models\MediasEditForm;

class MediasController extends Controller
{
	public function actionIndex()
	{
		$items = Medias::find()->all();

		return $this->render('index', [
			'items' => $items,
			'modelUpload' => new MediasUploadForm(),
			'modelRemove' => new MediasRemoveForm(),
			'modelEdit' => new MediasEditForm(),
		]);
	}
	public function actionUpload()
	{
		$model = new MediasUploadForm();
		
		if (Yii::$app->request->isPost) {

			$model->files = UploadedFile::getInstances($model, 'files');
			$model->upload();
			return $this->redirect('?r=medias/index');
		}
	}
	public function actionRemove()
	{
		$model = new MediasRemoveForm();
		
		if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
			$model->remove();
			return $this->redirect('?r=medias/index');
		}
	}
	public function actionEdit()
	{
		$model = new MediasEditForm();
		
		if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
			$model->edit();
			return $this->redirect('?r=medias/index');
		}
	}
}