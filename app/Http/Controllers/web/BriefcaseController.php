<?php

namespace App\Http\Controllers;

use App\Http\Controllers\web\WebBaseController;
use App\Models\BriefcaseType;
use App\Services\BriefcaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BriefcaseController extends WebBaseController
{
    private $briefcaseService;

    public function __construct(BriefcaseService $briefcaseService)
    {
        $this->briefcaseService = $briefcaseService;
    }

    public function index()
    {
        $briefcases = $this->briefcaseService->all();
        // todo render Inertia
    }

    public function myBriefcases()
    {
        $briefcases = $this->briefcaseService->allForUser(Auth::user()->id);
        // todo render Inertia
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required|max:255'],
            'description' => ['required'],
            'type_id' => ['required', 'exists:' . BriefcaseType::class . ',id'],
            'sum' => ['required'],
            'duration' => ['required'],
            'direct_fee' => ['required'],
            'awardable' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $briefcase = $this->briefcaseService->create(
            $request->only([
                'title',
                'description',
                'type_id',
                'sum',
                'duration',
                'direct_fee',
                'awardable'
            ]));

        return $this->responseSuccess('Created', $briefcase);
    }

    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            $this->briefcaseService->delete($request->input('id'));
        }

        return $this->responseSuccess('Deleted');
    }
}
