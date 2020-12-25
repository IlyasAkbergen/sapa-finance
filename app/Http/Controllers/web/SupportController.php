<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SupportController extends WebBaseController
{
    private $supportService;

    public function __construct(SupportService $supportService)
    {
        $this->supportService = $supportService;
    }
    public function index()
    {
        return Inertia::render('Support/Index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => ['required'],
        ]);

        DB::beginTransaction();

        try {
            $support = $this->supportService->create(
                array_merge(
                    $request->only(['message']),
                    ['user_id' => Auth::user()->id]
                )
            );
            DB::commit();

            if ($request->only(['uuid'])) {
                $attachment = Attachment::where('uuid', $request->only(['uuid']))->first();
                $attachment->model_id = $support->id;
                $attachment->save();
            }
            return $this->responseSuccess('Ваше обращение сохранено');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseFail('Не удалось сохранить.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
