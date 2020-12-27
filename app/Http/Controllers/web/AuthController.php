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
        $referrer_id = $request->input('referrer_id', null);

        $consultants = User::all(); // todo retrieve consultants

        $articles = Article::orderBy('created_at')
            ->limit(10)
            ->get();

        return view('welcome', compact([
            'referrer_id', 'consultants', 'articles'
        ]));
    }
}
