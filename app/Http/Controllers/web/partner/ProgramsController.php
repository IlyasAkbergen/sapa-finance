<?php

namespace App\Http\Controllers\web\partner;

use App\Http\Controllers\web\WebBaseController;
use App\Http\Requests\BriefcaseRequest;
use App\Models\Briefcase;
use App\Models\BriefcaseType;
use App\Models\Purchase;
use App\Models\User;
use App\Services\AttachmentService;
use App\Services\BriefcaseService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ProgramsController extends WebBaseController
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

    public function index()
    {
        $briefcases = Briefcase::where('partner_id', Auth::user()->id)
            ->get();

        return Inertia::render('Programs/Index', [
            'briefcases' => $briefcases,
            'types' => BriefcaseType::all()
        ]);
    }

    public function create($id)
    {
        return Inertia::render('Programs/Crud/Add',[
            'type' => intval($id)
        ]);
    }

    public function show($id)
    {
        $briefcase = $this->briefcaseService->find($id);

        if (!empty($briefcase) && $briefcase->partner_id == Auth::user()->id) {
            return Inertia::render('Programs/Crud/Edit', [
                'briefcase' => $briefcase,
            ]);
        } else {
            return redirect()->route('programs-crud.index');
        }
    }

    // PUT /programs-crud/{id}
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

        $data['partner_id'] = Auth::user()->id;

        $briefcase = $this->briefcaseService->update(
            $request->input('id'),
            $data
        );

        if (!empty($briefcase)) {
            return redirect()
                ->route('programs-crud.index');
        } else {
            return $this->responseFail('Не удалось обновить портфель');
        }
    }

    // POST /programs-crud
    public function store(BriefcaseRequest $request)
    {
        $data = $request->all();

        $filepath = $this->attachmentService->storeFile(
            $request->file('image'), 'Briefcase'
        );

        $data['image_path'] = $filepath;

        $data['partner_id'] = Auth::user()->id;

        $briefcase = $this->briefcaseService->create($data);
        if (!empty($briefcase)) {
            return redirect()
                ->route('programs-crud.index');
        } else {
            return $this->responseFail('failed saving briefcase');
        }
    }

    public function destroy($id)
    {
        $deleted = $this->briefcaseService->delete($id);

        if ($deleted) {
            return redirect()
                ->route('programs-crud.index');
        } else {
            return $this->responseFail('failed deleting briefcase');
        }
    }
}
