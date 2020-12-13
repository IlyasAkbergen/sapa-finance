<?php


namespace App\Services;


use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AttachmentServiceImpl extends BaseServiceImpl implements AttachmentService
{
    private $main_dir = 'attachments';

    public function __construct(Attachment $model)
    {
        parent::__construct($model);
    }

    public function setDir($dir_name)
    {
        $this->main_dir = $dir_name;
    }

    public function save($model_id, $model_type, $file, $uuid = null)
    {
        //Берем только имя модели без неймспейса
        $explode_type = explode('\\', $model_type);
        if(isset($explode_type[count($explode_type)-1])) {
            $type_path = $explode_type[count($explode_type)-1];
        } else {
            $type_path = $explode_type[0];
        }

        $fullpath = $this->storeFile($file, $type_path);

        $data['path'] = $fullpath;
        $data['name'] = $file->getClientOriginalName();
        $data['model_id'] = $model_id;
        $data['model_type'] = $model_type;
        $data['uuid'] = $uuid;

        return $image = $this->create($data);
    }

    public function move($uuid, $new_model_id)
    {
        $models = $this->getWhere([
            'model_id' => 0,
            'uuid' => $uuid
        ]);

        foreach ($models as $model) {
            $model->model_id = $new_model_id;
            $model->uuid = null;
            $model->save();
        }
    }

    public function storeFile($file, $folder)
    {
        $filename =  uniqid().'.'.File::extension($file->getClientOriginalName());
        $fullpath = $this->main_dir.'/'.strtolower($folder).'/'.$filename;

        Storage::disk('public')->put($fullpath,  File::get($file));

        return Storage::url($fullpath);
    }
}