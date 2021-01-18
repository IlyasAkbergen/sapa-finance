<?php

namespace App\Http\Controllers\web\admin;

use App\Enums\ReferralLevelEnum;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeReferrerRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\ReferralLevel;
use App\Models\Role;
use App\Models\User;
use App\Services\AttachmentService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
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
        $data = User::where('name', 'like', "%$request->search_key%")
            ->paginate(20);

        return Inertia::render('User/Crud/Index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return Inertia::render('User/Crud/Add', [
            'roles' => $roles,
            'referral_level' => ReferralLevel::all()
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->except('password');

        if ($request->has('image')) {
            $filepath = $this->attachmentService->storeFile(
                $request->file('image'), 'User'
            );

            $data['profile_photo_path'] = $filepath;
        }

        if ($request->has('password') && !empty($request->password)) {
            $data['password'] = Hash::make($request->input('password'));
        }

        if (!$request->has('referrer_id')) {
            $data['referrer_id'] = env('SAPA_USER_ID');
        }

        $user = $this->userService->create($data);

        if (!empty($user)) {
            event(new Registered($user));
            return redirect()
                ->route('users-crud.edit', $user->id);
        } else {
            return $this->responseFail('failed saving user');
        }
    }

    public function edit($id)
    {
        $user = User::with(['balance', 'all_referrals'])->findOrFail($id);
        $roles = Role::all();
        $all_clients = User::isClient()
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id,
                    'text' => $item->name
                ];
            });

        $referral_tree = data_get($user, 'all_referrals');

        if (!empty($user)) {
            return Inertia::render('User/Crud/Edit', [
                'client' => UserResource::make($user)->resolve(),
                'all_clients' => $all_clients,
                'roles' => $roles,
                'referral_level' => ReferralLevel::all(),
                'referral_tree' => $referral_tree
            ]);
        } else {
            return redirect()->route('users-crud.index');
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
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
                ->route('users-crud.index');
        } else {
            return $this->responseFail('Не удалось обновить пользователя');
        }
    }

    public function destroy($id)
    {
        $user = $this->userService->find($id);
        $user->update([
           'iin' => '_del_' . Carbon::now() . $user->iin,
           'email' => '_del_' . Carbon::now() . $user->email,
           'phone' => '_del_' . Carbon::now() . $user->phone,
        ]);

        $deleted = $user->delete($id);

        if ($deleted) {
            return redirect()->route('users-crud.index');
        } else {
            return $this->responseFail('Не удалось удалить');
        }
    }

    public function me() {
        if (Auth::check()) {
            Auth::user()->load('referrer');
            $user = UserResource::make(Auth::user())
                ->resolve();

            $roles = Role::all();

            return Inertia::render('User/Crud/Edit', [
                'client' => $user,
                'roles' => $roles,
                'referrer' => isset($user['referrer'])
                    ? $user['referrer']->resolve()
                    : null,
                'auth_user' => $user
            ]);
        } else {
            return redirect()->route('users-crud.index');
        }
    }

    public function show($id)
    {
        $client = User::find($id);

        if ($client) {
            return Inertia::render('User/Show', [
                'client' => $client
            ]);
        } else {
            return $this->responseFail('Не удалось найти пользователя');
        }
    }

    public function referralTree($id)
    {
        $client = User::find($id);

        if ($client) {
            return Inertia::render('User/ReferralTree', [
                'client' => $client
            ]);
        } else {
            return $this->responseFail('Не удалось найти пользователя');
        }
    }

    public function changeReferrer(ChangeReferrerRequest $request)
    {
        $parent_id = data_get($request, 'parent_id');
        $child = User::with('all_referrals')->findOrFail(data_get($request, 'child_id'));
        $all_childs_of_child = Helper::flat_all_referrals($child);

        if (!$all_childs_of_child->contains(function ($item) use ($parent_id) {
            return data_get($item, 'id') == $parent_id;
        })) {
            if (data_get($request, 'child_id') != data_get($request, 'parent')) {
                $user = User::findOrFail(data_get($request, 'child_id'));

                $user->update([
                    'referrer_id' => $parent_id
                ]);
            }
        }

        return redirect()->back();
    }
}
