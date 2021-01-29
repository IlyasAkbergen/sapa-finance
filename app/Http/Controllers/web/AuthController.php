<?php

namespace App\Http\Controllers\web;

use App\Enums\ReferralLevelEnum;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $referrer_id = $request->input('referrer_id', null);
        $consultants = User::where('referral_level_id', ReferralLevelEnum::Consultant)
            ->get();

        $articles = Article::orderBy('created_at')
            ->limit(10)
            ->get();

        $courses = Course::orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('welcome', compact([
            'referrer_id', 'consultants', 'articles', 'courses'
        ]));
    }
}
