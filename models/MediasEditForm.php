<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Medias;

class MediasEditForm extends Model
{
	public $id;
	public $url;
	public $desc;

	public function rules() {
		return [
			[['id', 'url', 'desc'], 'required'],
		];
	}
	public function edit() {

		if ($this->validate()) {
			$medias = Medias::find()->where(['id' => $this->id])->one();
			$medias->url = $this->url;
			$medias->desc = $this->desc;
			$medias->update(['id' => $this->id]);
			return true;
		} else {
			print_r($this->errors);
		}
		return false;
	}
}