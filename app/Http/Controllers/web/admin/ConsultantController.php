<?php

namespace App\Http\Controllers\web\admin;

use App\Enums\ReferralLevelEnum;
use App\Http\Controllers\web\WebBaseController;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\AttachmentService;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ConsultantController extends WebBaseController
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
        $data = User::where('referral_level_id', ReferralLevelEnum::Consultant)
            ->paginate(10);

        return Inertia::render('Consultant/Index', [
            'data' => $data
        ]);
    }

    public function edit($id)
    {
        $consultant = User::findOrFail($id);

        if ($consultant->referral_level_id != ReferralLevelEnum::Consultant) {
            return redirect()->route('consultants-crud.index');
        }

        return Inertia::render('Consultant/Edit', [
            'consultant' => $consultant
        ]);
    }

    public function create()
    {
        return Inertia::render('Consultant/Add');
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
            event(new Registered($user));
            return redirect()
                ->route('consultants-crud.index');
        } else {
            return $this->responseFail('failed saving user');
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
                ->route('consultants-crud.index');
        } else {
            return $this->responseFail('Не удалось обновить пользователя');
        }
    }

    public function destroy($id)
    {
        $deleted = $this->userService->delete($id);

        if ($deleted) {
            return redirect()->route('consultants-crud.index');
        } else {
            return $this->responseFail('Не удалось удалить');
        }
    }
}
