<?php

namespace App\Http\Controllers;

use App\Services\ArticlesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    private $articlesService;

    public function __construct(ArticlesService $articlesService)
    {
        $this->articlesService = $articlesService;
    }

    public function index()
    {
        $articles = $this->articlesService->all();

        // todo render in Inertia
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required|max:255'],
            'content' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = array_merge($request->only([
            'title', 'content'
        ]), ['author_id' => Auth::user()->id]);

        $article = $this->articlesService->create($attributes);

        return $this->responseSuccess('Created', $article);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'title' => ['required', 'max:255'],
            'content' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = array_merge($request->only([
            'title', 'content'
        ]), ['author_id' => Auth::user()->id]);

        $article = $this->articlesService->update(
            $request->input('id'),
            $attributes
        );

        return $this->responseSuccess('Updated', $article);
    }

    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            $this->articlesService->delete($request->input('id'));
        }

        return $this->responseSuccess('Deleted');
    }
}
