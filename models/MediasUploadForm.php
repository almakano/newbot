<?php
namespace app\models;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Medias;

class MediasUploadForm extends Model
{
	public $files;

	public function rules() {
		return [
			[['files'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 0],
		];
	}
	public function upload() {

		if ($this->validate()) {

			if(!is_dir($dir = './uploads/')) {
				mkdir($dir, 0775, true);
				chmod($dir, 0755);
			}
			// var_dump($dir);
			foreach ($this->files as $file) {
				$newfile = '/uploads/'.$file->baseName.'.'.$file->extension;
				$url = Yii::getAlias('@web').$newfile;
				$file->saveAs('.'.$newfile);
				$medias = new Medias();
				$medias->url = $url;
				$medias->save();
			}
			return true;
		}
		// var_dump($this);
		return false;
	}
}