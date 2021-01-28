<?php

namespace App\Http\Controllers;

use App\Enums\ReferralLevelEnum;
use App\Models\Article;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showCourse($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect()->route('welcome');
        }

        return view('course', compact([
            'course'
        ]));
    }

    public function showArticle($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return redirect()->route('welcome');
        }

        $related_articles = Article::inRandomOrder()
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();

        return view('article', compact([
            'article', 'related_articles'
        ]));
    }

    public function showConsultant($id)
    {
        $consultant = User::select([
                'name', 'description', 'referral_level_id', 'profile_photo_path'
            ])
            ->where('referral_level_id', ReferralLevelEnum::Consultant)
            ->where('id', $id)
            ->first();

        if (!$consultant) {
            return redirect()->route('welcome');
        }

        return view('consultant', compact([
            'consultant'
        ]));
    }
}
