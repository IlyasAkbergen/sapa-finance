<?php


namespace App\Services;


interface AttachmentService
{
    /**
     * @param string $dir_name
     */
    public function setDir($dir_name);

    /**
     * @param $model_id
     * @param $model_type
     * @param $file
     * @param null $uuid
     */
    public function save($model_id, $model_type, $file, $uuid = null);

    /**
     * @param $uuid
     * @param $new_model_id
     */
    public function move($uuid, $new_model_id);

    public function storeFile($file, $folder);
}