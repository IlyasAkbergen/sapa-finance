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

    // GET /briefcase
    public function index()
    {
        $briefcases = $this->briefcaseService->all();
        return Inertia('Briefcase/Briefcases', [
            'briefcases' => $briefcases
        ]);
    }
    
    // GET /my-briefcases
    public function my()
    {
        $briefcases = $this->briefcaseService->ofUser(Auth::user());

        return Inertia('Briefcase/Briefcases', [
            'briefcases' => $briefcases
        ]);
    }

    // POST /briefcases
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

    // DELETE /briefcases/{id}
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            $this->briefcaseService->delete($request->input('id'));
        }

        return $this->responseSuccess('Deleted');
    }

    // GET /briefcases/{id}
    public function show($id) {
        return null;
    }

    // PUT /briefcases/{id}
    public function update(Request $request) {}

    // GET /briefcases/edit/{id}
    public function edit($id) { return null; }

    // GET /briefcases/create
    public function create() {}
}
