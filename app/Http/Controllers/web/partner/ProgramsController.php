<?php

namespace App\Http\Controllers\web\partner;

use App\Http\Controllers\web\WebBaseController;
use App\Http\Requests\BriefcaseRequest;
use App\Models\Briefcase;
use App\Models\BriefcaseChange;
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
            ->with('active_change')
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

        if (Auth::user()->isAdmin) {
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
        } elseif (Auth::user()->isPartner) {
            $change = BriefcaseChange::create([
                'briefcase_id' => data_get($request, 'id'),
                'partner_id' => Auth::user()->id,
                'status' => BriefcaseChange::STATUS_CREATED,
                'type_id' => BriefcaseChange::TYPE_EDIT,
                'change_data' => $data
            ]);

            if (!empty($change)) {
                return redirect()
                    ->back()
                    ->with([
                        'message' => 'Запрос на изменение программы успешно отправлен',
                        'sub_message' => 'Ожидайте ответа модератора'
                    ]);
            } else {
                return $this->responseFail('Не удалось создать завпрос');
            }
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
        $briefcase->delete();

        BriefcaseChange::create([
            'briefcase_id' => data_get($briefcase, 'id'),
            'partner_id' => Auth::user()->id,
            'status' => BriefcaseChange::STATUS_CREATED,
            'type_id' => BriefcaseChange::TYPE_CREATE,
            'data' => null
        ]);

        return redirect()
            ->route('programs-crud.index')
            ->with([
                'message' => 'Запрос на добавление программы успешно отправлен',
                'sub_message' => 'Ожидайте ответа модератора'
            ]);
    }

    public function destroy($id)
    {
        if (Auth::user()->isAdmin) {
            $deleted = $this->briefcaseService->delete($id);

            if ($deleted) {
                return redirect()
                    ->route('programs-crud.index');
            } else {
                return $this->responseFail('failed deleting briefcase');
            }
        } elseif (Auth::user()->isPartner) {
            $change = BriefcaseChange::create([
                'briefcase_id' => $id,
                'partner_id' => Auth::user()->id,
                'status' => BriefcaseChange::STATUS_CREATED,
                'type_id' => BriefcaseChange::TYPE_DELETE,
                'data' => null
            ]);

            if (!empty($change)) {
                return redirect()
                    ->back()
                    ->with([
                        'message' => 'Запрос на удаление программы успешно отправлен',
                        'sub_message' => 'Ожидайте ответа модератора'
                    ]);
            } else {
                return $this->responseFail('Не удалось создать запрос');
            }
        }
    }
}
