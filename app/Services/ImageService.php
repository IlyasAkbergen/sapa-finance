<?php


namespace App\Services;


use App\Models\Attachment;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    CONST MAIN_DIR = 'images';

    public function all()
    {
        return Attachment::all();
    }

    public function find($id)
    {
        return Image::findOrFail($id);
    }

    public function findMaxId($model_id, $model_type, $uuid)
    {
        return Image::where('model_id', $model_id)
            ->where('model_type', $model_type)
            ->where('uuid', $uuid)
            ->count();
    }

    public function saveCommon($file) {
        $filename =  uniqid().'.'.File::extension($file->getClientOriginalName());
        $fullpath = self::MAIN_DIR.'/common/'.$filename;

        $storage = Storage::disk('public')->put($fullpath,  File::get($file));
        return $fullpath;
    }

    public function saveImage($model_id, $model_type, $file, $uuid=null) {

        //Берем только имя модели без неймспейса
        $explode_type = explode('\\',$model_type);
        if(isset($explode_type[count($explode_type)-1])) {
            $type_path = $explode_type[count($explode_type)-1];
        } else {
            $type_path = $explode_type[0];
        }

        $filename =  uniqid().'.'.File::extension($file->getClientOriginalName());
        $fullpath = self::MAIN_DIR.'/'.strtolower($type_path).'/'.$filename;

        $path = Storage::disk('public')->put($fullpath,  File::get($file));

        $data['path'] = $fullpath;
        $data['name'] = $file->getClientOriginalName();
        $data['model_id'] = $model_id;
        $data['model_type'] = $model_type;
        $data['uuid'] = $uuid;
        $data['position'] = $this->findMaxId($model_id, $model_type, $uuid) + 1;

        $data['user_id'] = Auth::user()->id;

        return $image = $this->create($data);
    }

    public function moveImages($uuid, $new_model_id, $new_model_type) {
        $models = Image::where('model_id',0)->where('uuid', $uuid)->get();
        foreach ($models as $model) {
            $model->model_id = $new_model_id;
            $model->uuid = null;
            $model->save();
        }
    }

    public function create($data) {
        $image = new Image();
        $image->fill($data);
        $image->save();
        return $image;
    }
}