<?php

namespace App\Http\Controllers\web\partner;

use App\Http\Controllers\Controller;
use App\Http\Controllers\web\WebBaseController;
use App\Http\Requests\BriefcasePaymentRequest;
use App\Http\Requests\BriefcaseUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\BriefcaseUserResourse;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\UserResource;
use App\Models\Briefcase;
use App\Models\Payment;
use App\Models\Purchase;
use App\Models\ReferralLevel;
use App\Models\Role;
use App\Models\User;
use App\Models\UserBriefcase;
use App\Services\AttachmentService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PartnerUserController extends WebBaseController
{
    private $userService;
    private $attachmentService;

    public function __construct(
        UserService $userService,
        AttachmentService $attachmentService
    )
    {
        $this->userService = $userService;
        $this->attachmentService = $attachmentService;
    }

    public function index(Request $request)
    {
        $data = User::where('partner_id', Auth::user()->id)
            ->paginate(20);

        return Inertia::render('User/Crud/Index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return Inertia::render('User/Crud/Add', [
            'roles' => [],
            'referral_level' => ReferralLevel::all(),
            'partner_id' => Auth::user()->id
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->except('password');

        $filepath = $this->attachmentService->storeFile(
            $request->file('image'), 'User'
        );

        $data['profile_photo_path'] = $filepath;

        if ($request->has('password') && !empty($request->password)) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $data['partner_id'] = $request->user()->id;
        $data['role_id'] = Role::ROLE_CLIENT;

        if (!$request->has('referrer_id')) {
            $data['referrer_id'] = env('SAPA_USER_ID');
        }

        $user = $this->userService->create($data);

        if (!empty($user)) {
            event(new Registered($user));
            return redirect()
                ->route('partner-users.index');
        } else {
            return $this->responseFail('failed saving user');
        }
    }

    public function edit($id)
    {
        $user = $this->userService->findWith($id, ['balance']);

        if (!empty($user) && $user->partner_id == Auth::user()->id) {
            return Inertia::render('User/Crud/Edit', [
                'client' => UserResource::make($user)->resolve(),
                'roles' => [],
                'referral_level' => ReferralLevel::all(),
                'partner_id' => Auth::user()->id
            ]);
        } else {
            return redirect()->route('partner-users.index');
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        if ($request->has('partner_id')
            && $request->user()->id == data_get($request, 'partner_id')) {
            $data = $request->except('password');

            if ($request->has('image')) {
                $filepath = $this->attachmentService->storeFile(
                    $request->file('image'),
                    'User'
                );

                $data['profile_photo_path'] = $filepath;
            }

            if ($request->has('password') && !empty($request->password)) {
                $data['password'] = Hash::make($request->input('password'));
            }

            if (!$request->has('referrer_id')) {
                $data['referrer_id'] = env('SAPA_USER_ID');
            }

            $user = $this->userService->update(
                $request->input('id'),
                $data
            );

            $user->balance()->update([
                'direct_points' => data_get($request, 'direct_points'),
                'team_points' => data_get($request, 'team_points')
            ]);

            if (!empty($user)) {
                return redirect()
                    ->route('partner-users.index');
            } else {
                return $this->responseFail('Не удалось обновить пользователя');
            }
        } else {
            return redirect()
                ->route('partner-users.index');
        }
    }

    public function orders(Request $request)
    {
        $data = UserBriefcase::where(
            'status', UserBriefcase::STATUS_PENDING
        )
        ->has('briefcase')
        ->with('user', 'briefcase')
        ->paginate(20);

        $orders = BriefcaseUserResourse::collection($data->items())
            ->resolve();

        return Inertia::render('Partner/Order/Orders', [
            'orders' => $orders,
            'data' => $data
        ]);
    }

    public function acceptOrder($id)
    {
        $data = [
            'contract_number' => strtoupper(Str::random(10)), // todo increment prev contract
            'status' => UserBriefcase::STATUS_ACCEPTED
        ];

        return $this->__updateOrder($id, $data);
    }

    public function rejectOrder($id)
    {
        $data = [
            'status' => UserBriefcase::STATUS_REJECTED
        ];

        return $this->__updateOrder($id, $data);
    }

    private function __updateOrder($id, $data)
    {
        $order = UserBriefcase::find($id);

        if ($order) {
            $order->update($data);

            return redirect()->route('admin.briefcase-orders');
        } else {
            return $this->responseFail('Не удалось сохранить оценку.');
        }
    }

    public function activeOrders()
    {
        $data = UserBriefcase::where(
                'status', UserBriefcase::STATUS_ACCEPTED
            )
            ->when(Auth::user()->isPartner, function ($q) {
                return $q->whereHas('briefcase', function ($q) {
                    return $q->where('partner_id', Auth::user()->id);
                });
            })
            ->with('user', 'briefcase')
            ->paginate(20);

        $orders = BriefcaseUserResourse::collection($data->items())
            ->resolve();

        return Inertia::render('Partner/Order/Deals', [
            'orders' => $orders,
            'data' => $data
        ]);
    }

    public function editOrder($id)
    {
        $order = UserBriefcase::with(
            'briefcase',
            'user'
        )->find($id);

        if (!empty($order)
            && ($order->briefcase->partner_id == Auth::user()->id
                || Auth::user()->isAdmin)
        ) {
            return Inertia::render('Partner/Order/Edit', [
                'order' => BriefcaseUserResourse::make($order)->resolve(),
            ]);
        } else {
            return redirect()->route('partner-users.deals');
        }
    }

    public function updateOrder(BriefcaseUserRequest $request)
    {
        $order = UserBriefcase::with('user', 'briefcase')
            ->find(data_get($request, 'id'));

        if (!empty($order)
            && ($order->briefcase->partner_id == Auth::user()->id
                || Auth::user()->isAdmin)
        ) {
            $order->update([
                'contract_number' => data_get($request, 'contract_number'),
                'sum' => data_get($request, 'sum'),
                'profit' => data_get($request, 'profit'),
                'duration' => data_get($request, 'duration'),
                'monthly_payment' => data_get($request, 'monthly_payment'),
            ]);

            return redirect()->route('partner-users.deals');
        } else {
            return redirect()->route('partner-users.deals');
        }
    }

    public function payments()
    {
        $data = Payment::query()
            ->with([
                'payable.purchasable', 'user'
            ])
            ->where(
                'status',
                Payment::PAYMENT_STATUS_OK
            )
            ->paginate(20);

        return Inertia::render('Payments/Index', [
            'data' => $data,
            'payments' => PaymentResource::collection(
                $data->items()
            )
            ->resolve()
        ]);
    }

    public function storePayment(BriefcasePaymentRequest $request)
    {
        $order = UserBriefcase::with('user', 'briefcase')
            ->find(data_get($request, 'order_id'));

        if (
            $order->briefcase->partner_id != Auth::user()->id
            && !Auth::user()->isAdmin
        ) {
            return $this->responseFail('failed saving briefcase');
        }

        $payable = Purchase::firstOrCreate([
               'id' => data_get($order, 'purchase_id')
            ], [
                'user_id' => data_get($request, 'user_id'),
                'purchasable_id' => $order->briefcase->id,
                'purchasable_type' => Briefcase::class,
            ]);

        $paid_at = data_get($request, 'paid_at');

        if ($paid_at) {
            $paid_at = Carbon::parse($paid_at);
        }

        $payment = Payment::create([
            'status' => Payment::PAYMENT_STATUS_OK,
            'sum' => data_get($request, 'sum'),
            'user_id' => data_get($request, 'user_id'),
            'payable_id' => $payable->id,
            'payable_type' => Purchase::class,
            'paid_at' => $paid_at
        ]);

        if (!empty($payment)) {
            return redirect()
                ->route('partner-users-order.edit', $order->id);
        } else {
            return $this->responseFail('failed saving briefcase');
        }
    }
}
