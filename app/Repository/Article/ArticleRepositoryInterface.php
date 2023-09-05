<?php

namespace App\Repository\Article;

use App\Http\Requests\Article\UpdateRequest;
use App\Models\Activity;


interface ArticleRepositoryInterface{
    public function updateArticle(Activity $activity, UpdateRequest $request);
}


