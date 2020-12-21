<?php

namespace App\Http\Controllers\web;

use App\Models\Complaint;
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
            'to_user_id' => 'required',
            'from_user_id' => 'required',
        ]);

        $complaint = Complaint::create($request->only([
            'to_user_id', 'from_user_id'
        ]));

        if (!empty($complaint)) {
            return response()->json([
                'success' => true,
                'complaint' => $complaint,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }
}
