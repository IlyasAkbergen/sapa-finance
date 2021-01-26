<?php

namespace App\Http\Controllers\web;

use App\Enums\ReferralLevelEnum;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Inertia\Inertia;
use App\Models\User;

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

        $consultants = User::where(
            'referral_level_id', ReferralLevelEnum::Consultant()
        )->get();

        return Inertia::render('Complaint/Crud/Index', [
            'data' => $complaints,
            'consultants' => $consultants
        ]);
    }

    public function forUser($id)
    {
        $data = Complaint::with([
            'to_user', 'from_user'
        ])
        ->where('to_id', $id)
        ->paginate(10);

        $user = User::findOrFail($id);

        return Inertia::render('Consultant/Complaints', [
            'data' => $data,
            'user' => $user
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

    public function destroy($id)
    {
        $deleted = Complaint::findOrFail($id)->delete();

        if ($deleted) {
            return redirect()->back();
        } else {
            return $this->responseFail('Не удалось удалить');
        }
    }

    public function changeReferral(Request $request) {
        User::updateReferral($request->user_id, $request->id);
        return response()->json(['success'=>true]);
    }
}
