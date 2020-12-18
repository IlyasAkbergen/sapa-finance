<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\web\WebBaseController;
use App\Http\Middleware\IsAdmin;
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
        $this->middleware(IsAdmin::class)
            ->except([
                'index', 'show', 'my'
            ]);
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

    // GET /briefcases/{id}
    public function show($id)
    {
        return null;
    }

    // PUT /briefcases/{id}
    public function update(Request $request)
    {
    }

    // GET /briefcases/edit/{id}
    public function edit($id)
    {
        return null;
    }

    // GET /briefcases/create
    public function create()
    {
    }
}
