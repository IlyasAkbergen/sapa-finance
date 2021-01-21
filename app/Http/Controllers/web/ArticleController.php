<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\web\WebBaseController;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Services\ArticlesService;
use App\Services\AttachmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ArticleController extends WebBaseController
{
    private $articlesService;
    private $attachmentService;

    public function __construct(
        ArticlesService $articlesService,
        AttachmentService $attachmentService
    )
    {
        $this->articlesService = $articlesService;
        $this->attachmentService = $attachmentService;
        $this->middleware('admin')
            ->except(['index', 'show']);
    }

    public function index()
    {
        $articles = $this->articlesService->allWith(['image']);

        return Inertia::render('Articles/Index', [
            'articles' => ArticleResource::collection($articles)->resolve()
        ]);
    }

    public function create()
    {
        return Inertia::render('Articles/Crud/Add');
    }

    public function edit($id)
    {
        $article = $this->articlesService->find($id);

        if (!empty($article)) {
            return Inertia::render('Articles/Crud/Edit', [
                'article' => ArticleResource::make($article)->resolve()
            ]);
        } else {
            return redirect()->route('articles.index');
        }
    }

    public function show($id)
    {
        $article = $this->articlesService->find($id);

        if (!empty($article)) {
            return Inertia::render('Articles/ArticleDetail', [
                'article' => ArticleResource::make($article)->resolve()
            ]);
        } else {
            return redirect()->route('articles.index');
        }
    }

    public function store(ArticleRequest $request)
    {
        $filepath = $this->attachmentService->storeFile(
            $request->file('image'), 'Article'
        );

        $attributes = array_merge($request->only([
            'title', 'content', 'video_url', 'created_at'
        ]), [
            'author_id' => Auth::user()->id,
            'image_path' => $filepath,
        ]);

        $article = $this->articlesService->create($attributes);

        if (!empty($article)) {
            $this->attachmentService->move($request->uuid, $article->id);

            return redirect()
                ->route('articles.edit', $article->id);
        } else {
            return $this->responseFail('failed saving article');
        }
    }

    public function update(ArticleRequest $request)
    {
        $attributes = array_merge($request->only([
            'title', 'content', 'video_url', 'created_at'
        ]), [
            'author_id' => Auth::user()->id,
        ]);

        if ($request->has('image')) {
            $filepath = $this->attachmentService->storeFile(
                $request->file('image'), 'Article'
            );

            $attributes['image_path'] = $filepath;
        }

        $article = $this->articlesService->update(
            $request->input('id'),
            $attributes
        );

        if (!empty($article)) {
            return redirect()
                ->route('articles.index');
        } else {
            return $this->responseFail('Не удалось обновить новость');
        }
    }

    public function destroy($id)
    {
        $deleted = $this->articlesService->delete($id);
        if ($deleted) {
            return redirect()->route('articles.index');
        } else {
            return $this->responseFail('Не удалось удалить');
        }
    }
}
