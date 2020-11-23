<?php


namespace App\Services;


use App\Models\Article;

class ArticlesServiceImpl extends BaseServiceImpl implements ArticlesService
{
    public function __construct(Article $model)
    {
        parent::__construct($model);
    }
}