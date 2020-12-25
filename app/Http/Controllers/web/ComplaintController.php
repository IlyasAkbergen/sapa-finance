<?php

namespace App\Http\Controllers\web;

use App\Http\Resources\UserResource;
use App\Models\Complaint;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComplaintController extends WebBaseController
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $complaints = Complaint::with([
            'to_user', 'from_user'
        ])->paginate(10);

        $consultants = User::all(); //where(
//            'referral_level_id', ReferralLevelEnum::Consultant()
//        )->get();

        return Inertia::render('Complaint/Crud/Index', [
            'data' => $complaints,
            'consultants' => $consultants
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'from_id' => 'required',
            'to_id' => 'required'
        ]);

        $complaint = Complaint::create($request->only([
            'content', 'from_id', 'to_id'
        ]));

        if (!empty($complaint)) {
            return $this->responseSuccess('Ваше обращение сохранено');
        } else {
            return $this->responseFail('Не удалось сохранить.');
        }
    }

    public function create($id, $referrer_id)
    {
        return Inertia::render('Complaint/Crud/Add', [
            'from_id' => $id,
            'to_id' => $referrer_id
        ]);
    }
}
