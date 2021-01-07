<?php

namespace App\Http\Controllers\web\partner;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Role;
use App\Services\AttachmentService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class CabinetController extends Controller
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

    public function index()
    {
        return Inertia::render('Partner/Profile', [
            'partner' => PartnerResource::make(Auth::user())->resolve(),
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        if (!empty($user)) {
            return Inertia::render('Partner/Crud/Edit', [
                'partner' => PartnerResource::make($user)->resolve(),
            ]);
        } else {
            return redirect()->route('partner-cabinet.index');
        }
    }

    public function update(UpdatePartnerRequest $request)
    {
        $data = $request->except('password');

        if ($request->has('password') && !empty($request->password)) {
            $data['password'] = Hash::make($request->input('password'));
        }
        $user = $this->userService->update(
            $request->input('id'),
            $data
        );
        if (!empty($user)) {
            return redirect()
                ->route(
                    Auth::user()->role_id == Role::ROLE_ADMIN
                        ? 'partners-crud.index'
                        : 'partner-cabinet.index'
                );
        } else {
            return $this->responseFail('Не удалось обновить пользователя');
        }
    }
}
