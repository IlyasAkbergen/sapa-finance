<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $user = new User();

        if ($request->has('referrer_id')) {
            $user->referrer_id = $request->input('referrer_id');
        }

        $consultants = User::all(); // todo retrieve consultants

        $articles = Article::orderBy('created_at')
            ->limit(10)
            ->get();

        return view('welcome', compact([
            'user', 'consultants', 'articles'
        ]));
    }
}
