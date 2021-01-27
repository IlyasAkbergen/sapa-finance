<?php

namespace App\Http\Controllers\web;

use App\Enums\ReferralLevelEnum;
use App\Http\Controllers\web\WebBaseController;
use App\Http\Middleware\IsAdmin;
use App\Http\Resources\DealResource;
use App\Models\Briefcase;
use App\Models\BriefcaseType;
use App\Models\Purchase;
use App\Models\User;
use App\Models\UserBriefcase;
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
        $consultants = User::query()
            ->where('referral_level_id', ReferralLevelEnum::Consultant)
            ->get();

        return Inertia('Briefcase/Briefcases', [
            'briefcases' => $briefcases,
            'consultants' => $consultants
        ]);
    }

    // GET /my-briefcases
    public function my()
    {
        $deals = UserBriefcase::query()
            ->where('user_id', Auth::user()->id)
            ->with(['briefcase', 'purchase.payments'])
            ->get()
            ->filter(function ($item) {
                return data_get($item, 'briefcase')
                    && data_get($item, 'purchase.payments');
            });

        return Inertia('Briefcase/Deals', [
            'deals' => DealResource::collection($deals)->resolve()
        ]);
    }

    public function attachToMe(Request $request)
    {
        $type_id = data_get($request, 'type_id');
        Validator::make($request->all(), [
            'briefcase_id' => 'required|integer',
            'monthly_payment' => $type_id == BriefcaseType::TYPE_CUMULATIVE
                ? '|required' : '',
            'duration' => 'required|integer',
            'sum' => $type_id == BriefcaseType::TYPE_ONE_TIME
                ? '|required' : ''
        ], [
            'monthly_payment.required' => 'Укажите размер ежемесячного взноса',
            'monthly_payment.integer' => 'Значение должно быть числом',
            'duration.required' => 'Укажите срок',
            'sum.required' => 'Укажите общую сумму договора',
            'duration.integer' => 'Значение должно быть числом',
        ])->validate();

        $id = data_get($request, 'briefcase_id');
        $monthly_payment = data_get($request, 'monthly_payment');
        $duration = data_get($request, 'duration');
        $sum = data_get($request, 'sum');

        $purchase = Purchase::create([
            'user_id' => Auth::user()->id,
            'sum' => $sum ?: 0,
            'purchasable_id' => $id,
            'purchasable_type' => Briefcase::class,
            'payed' => true,
            'with_feedback' => true,
        ]);

        Auth::user()->briefcases()->attach([
            $id => [
                'purchase_id' => $purchase->id,
                'consultant_id' => Auth::user()->referrer_id
                    ?: User::where(
                        'referral_level_id',
                        ReferralLevelEnum::Consultant)
                        ->first()->id,
                'monthly_payment' => $monthly_payment,
                'duration' => $duration,
                'sum' => $sum ?: ($monthly_payment * $duration)
            ]
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
