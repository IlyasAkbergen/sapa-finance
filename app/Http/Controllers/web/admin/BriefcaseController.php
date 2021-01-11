<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\web\WebBaseController;
use App\Http\Requests\BriefcaseRequest;
use App\Http\Resources\BriefcaseResource;
use App\Models\Briefcase;
use App\Models\BriefcaseType;
use App\Services\AttachmentService;
use App\Services\BriefcaseService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BriefcaseController extends WebBaseController
{
    private $briefcaseService;
    private $attachmentService;

    public function __construct(
        BriefcaseService $briefcaseService,
        AttachmentService $attachmentService
    )
    {
        $this->briefcaseService = $briefcaseService;
        $this->attachmentService = $attachmentService;
    }

    public function index(Request $request)
    {
        $data = Briefcase::where('title', 'like', "%$request->search_key%")
            ->with('type')
            ->paginate(10);

        $items = BriefcaseResource::collection($data->items())
            ->resolve();

        return Inertia::render('Briefcase/Crud/Index', [
            'data' => $data,
            'items' => $items
        ]);
    }

    public function create()
    {
        return Inertia::render('Briefcase/Crud/Add', [
            'types' => BriefcaseType::all()
        ]);
    }

    // POST /briefcases
    public function store(BriefcaseRequest $request)
    {
        $data = $request->all();

        $filepath = $this->attachmentService->storeFile(
            $request->file('image'), 'Briefcase'
        );

        $data['image_path'] = $filepath;

        $briefcase = $this->briefcaseService->create($data);

        if (!empty($briefcase)) {
            return redirect()
                ->route('briefcases-admin.edit', $briefcase->id);
        } else {
            return $this->responseFail('failed saving briefcase');
        }
    }

    public function edit($id)
    {
        $briefcase = $this->briefcaseService->find($id);

        if (!empty($briefcase)) {
            return Inertia::render('Briefcase/Crud/Edit', [
                'briefcase' => $briefcase,
                'types' => BriefcaseType::all()
            ]);
        } else {
            return redirect()->route('briefcases-admin.index');
        }
    }

    public function update(BriefcaseRequest $request)
    {
        $data = $request->all();

        if ($request->has('image')) {
            $filepath = $this->attachmentService->storeFile(
                $request->file('image'),
                'Briefcase'
            );

            $data['image_path'] = $filepath;
        }

        $briefcase = $this->briefcaseService->update(
            $request->input('id'),
            $data
        );

        if (!empty($briefcase)) {
            return redirect()
                ->route('briefcases-admin.index');
        } else {
            return $this->responseFail('Не удалось обновить портфель');
        }
    }

    // DELETE /briefcases/{id}
    public function destroy($id)
    {
        $deleted = $this->briefcaseService->delete($id);

        if ($deleted) {
            return redirect()->route('briefcases-admin.index');
        } else {
            return $this->responseFail('Не удалосьу удалить');
        }
    }
}
