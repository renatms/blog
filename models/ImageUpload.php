<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;

        if ($this->validate()) {
            $this->deleteCurrentImage($currentImage);

            return $this->saveImage();

        }
    }

    /**
     * @return string
     */
    private function getFolder()
    {
        return Yii::getAlias('@app/web') . '/uploads/';
    }

    /**
     * @return string
     */
    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    /**
     * @param $currentImage
     */
    public function deleteCurrentImage($currentImage)
    {
        if ($this->fileExist($currentImage)) {
            unlink($this->getFolder() . $currentImage);
        }
    }

    /**
     * @param $currentImage
     * @return bool
     */
    public function fileExist($currentImage)
    {
        if (!empty($currentImage) && $currentImage !== null) {
            return file_exists($this->getFolder() . $currentImage);
        }

    }

    /**
     * @return string
     */
    public function saveImage()
    {
        $filename = $this->generateFilename();

        $this->image->saveAs($this->getFolder() . $filename);

        return $filename;
    }


}