<?php
namespace app\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Medias;

class MediasRemoveForm extends Model
{
	public $id;

	public function rules() {
		return [
			[['id'], 'required'],
		];
	}
	public function remove() {

		if ($this->validate()) {
			
			$medias = Medias::find()->where(['id' => $this->id])->one();

			if(is_file($file = '.'.preg_replace('~^'.Yii::getAlias('@web').'~', '', $medias->url)))
				unlink($file);
			
			$medias->delete();

			return true;
		}

		return false;
	}
}