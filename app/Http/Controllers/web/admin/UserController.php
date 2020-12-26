<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Services\AttachmentService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            ->paginate(10);

        return Inertia::render('User/Crud/Index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return Inertia::render('User/Crud/Add', [
            'roles' => $roles
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

        $user = $this->userService->create($data);

        if (!empty($user)) {
            return redirect()
                ->route('users-crud.edit', $user->id);
        } else {
            return $this->responseFail('failed saving user');
        }
    }

    public function edit($id)
    {
        $user = $this->userService->findWith($id, ['balance']);
        $roles = Role::all();
        $auth_user = Auth::user();
        if (!empty($user)) {
            return Inertia::render('User/Crud/Edit', [
                'client' => UserResource::make($user)->resolve(),
                'roles' => $roles,
                'auth_user' => UserResource::make($user)->resolve()
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

        $user = $this->userService->update(
            $request->input('id'),
            $data
        );

        if (!empty($user)) {
            return redirect()
                ->route('users-crud.index');
        } else {
            return $this->responseFail('Не удалось обновить пользователя');
        }
    }

    public function destroy($id)
    {
        $deleted = $this->userService->delete($id);

        if ($deleted) {
            return redirect()->route('users-crud.index');
        } else {
            return $this->responseFail('Не удалось удалить');
        }
    }

    public function me() {
        $user = Auth::user();
        $roles = Role::all();
        $referer = User::find($user->referrer_id);
        if (!empty($user)) {
            return Inertia::render('User/Crud/Edit', [
                'client' => UserResource::make($user)->resolve(),
                'roles' => $roles,
                'referrer' => UserResource::make($referer)->resolve(),
                'auth_user' => UserResource::make($user)->resolve()
            ]);
        } else {
            return redirect()->route('users-crud.index');
        }
    }
}
