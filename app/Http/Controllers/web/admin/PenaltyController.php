<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\web\WebBaseController;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\BalanceOperation;
use App\Models\Penalty;
use App\Services\ArticlesService;
use App\Services\AttachmentService;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PenaltyController extends WebBaseController
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'direct_points' => 'required|integer',
            'team_points' => 'required|integer',
        ]);

        DB::beginTransaction();

        $penalty = null;

        try {
            $penalty = Penalty::create($request->only([
                'user_id', 'direct_points', 'team_points'
            ]));

            $penalty->load('user');

            BalanceOperation::create([
                'source_balance_id' => $penalty->user->balance_id,
                'direct_points' => $request->input('direct_points'),
                'team_points' => $request->input('team_points'),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        $response = [
            'success' => !empty($penalty),
            'penalty' => $penalty
        ];

        return response()->json($response);
    }
}
