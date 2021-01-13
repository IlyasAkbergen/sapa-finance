<?php

namespace App\Http\Controllers\web;

use App\Enums\ReferralLevelEnum;
use App\Http\Controllers\web\WebBaseController;
use App\Http\Middleware\IsAdmin;
use App\Models\Briefcase;
use App\Models\BriefcaseType;
use App\Models\Purchase;
use App\Models\User;
use App\Services\BriefcaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class BriefcaseController extends WebBaseController
{
    private $briefcaseService;

    public function __construct(BriefcaseService $briefcaseService)
    {
        $this->middleware(IsAdmin::class)
            ->except([
                'index', 'show', 'my', 'attachToMe'
            ]);
        $this->briefcaseService = $briefcaseService;
    }

    // GET /briefcase
    public function index()
    {
        $briefcases = $this->briefcaseService->allWith(['auth_user_pivot']);
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

    public function attachToMe($id)
    {
        Auth::user()->briefcases()->syncWithoutDetaching([
            $id => [
                'consultant_id' => Auth::user()->referrer_id
                    ?: User::where(
                        'referral_level_id',
                        ReferralLevelEnum::Consultant)
                        ->first()->id
            ]
        ]);

        Purchase::create([
           'user_id' => Auth::user()->id,
            'sum' => 0,
            'purchasable_id' => $id,
            'purchasable_type' => Briefcase::class,
            'payed' => true,
            'with_feedback' => true,
        ]);

        return redirect()->route('my-briefcases');
    }

    // GET /briefcases/{id}
    public function show($id)
    {
        $briefcase = $this->briefcaseService->find($id);

        if (!empty($briefcase)) {
            return Inertia::render('Briefcase/BriefcaseDetail', [
                'briefcase' => $briefcase,
            ]);
        } else {
            return redirect()->route('briefcases-admin.index');
        }
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
