<?php

namespace App\Http\Controllers;

use App\Http\Controllers\web\WebBaseController;
use App\Http\Resources\ArticleResource;
use App\Services\ArticlesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ArticleController extends WebBaseController
{
    private $articlesService;

    public function __construct(ArticlesService $articlesService)
    {
        $this->articlesService = $articlesService;
    }

    public function index()
    {
        $articles = $this->articlesService->allWith(['image']);

        return Inertia::render('Articles/Index', [
            'articles' => ArticleResource::collection($articles)->resolve()
        ]);
    }

    public function show($id)
    {
        $article = $this->articlesService->findWith($id, ['image']);

        return Inertia::render('Articles/ArticleDetail', [
            'article' => ArticleResource::make($article)->resolve()
        ]);
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
