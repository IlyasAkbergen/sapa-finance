<?php

namespace App\Http\Controllers\web\partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\ReferralLevel;
use App\Models\Role;
use App\Models\User;
use App\Services\AttachmentService;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class PartnerUserController extends Controller
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

            $user = $this->userService->update(
                $request->input('id'),
                $data
            );

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
}
