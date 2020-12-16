<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Briefcase;
use App\Models\Course;
use App\Models\Lesson;
use App\Services\AttachmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    private $repository;
    const COMMON_EXTENSIONS = 'odt,ods,png,jpg,jpeg,rar,zip,doc,docx,DOCX,xls,xlsx,pdf,ppt,pptx,gif,txt,mp4';

    private $attachments = [
        'course' => [
            'model' => Course::class,
            'rights' => [],
            'disk' => 'public',
        ],
        'briefcase' => [
            'model' => Briefcase::class,
            'rights' => [],
            'disk' => 'public'
        ],
        'lesson' => [
            'model' => Lesson::class,
            'rights' => [],
            'disk' => 'public'
        ]
    ];


    public function __construct(AttachmentService $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $model_id   = $request->input('model_id', 0);
        $model_type = $request->input('model_type');
        $model_uuid = $request->input('uuid', null);
        $slug = $request->input('slug', null);

       if(!isset($this->attachments[$model_type])) {
            abort(404);
       }

        $model_params = $this->attachments[$model_type];
        $model_name = $model_params['model'];

        // расширения
        $extensions = isset($model_params['extensions'])
            ? implode(",", $model_params['extensions'])
            : self::COMMON_EXTENSIONS;

        $request->validate([
            'file' => 'mimes:' . $extensions,
        ]);

        $data = $this->repository->save(
            $model_id,
            $model_name,
            $request->file('file'),
            $model_uuid,
            $slug
        );

        $response = [
            'success' => true,
            'data'    => $data
        ];

        return response()->json($response);
    }

    public function list(Request $request)
    {
        $data = $request->only('model_type', 'model_id', 'uuid', 'slug');

        if(!isset($this->attachments[$data['model_type']])) {
            abort(404);
        }

        $model_params = $this->attachments[$data['model_type']];
        $model_name = $model_params['model'];

        $attachments = Attachment::where('model_type', $model_name)
            ->when(!empty($data['model_id']), function ($query) use ($data) {
                return $query->where('model_id', $data['model_id'])
                    ->where('model_id', '!=', 0);
            })
            ->when(!empty($data['uuid']), function ($query) use ($data) {
                return $query->where('uuid', $data['uuid']);
            })
            ->when(!empty($data['slug']), function ($query) use ($data) {
                return $query->where('slug', $data['slug']);
            })
            ->orderBy('position')->get();

        return response()->json([
            'count' => count($attachments),
            'data'  => $attachments->all(),
        ]);
    }

    public function destroy($id) {
        $model = Attachment::findOrFail($id);
        try {
            if( true ) { // todo check
                Storage::disk('local')->delete($model->path);
                $model->delete();
            } else {
                abort(403);
            }

            return response()->json(['id' => $id]);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function sort(Request $request)
    {
        $count = 0;
        foreach ($request->input('ids') as $image_id) {
            $attachment = Attachment::where('id', $image_id)->where('user_id', Auth::id())->first();
            $attachment->position = $count;
            $attachment->save();
            $count++;;
        }
        return $this->responseSuccess(true);
    }
}
