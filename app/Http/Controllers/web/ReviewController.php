<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 26.01.2021
 * Time: 20:39
 */

namespace App\Http\Controllers\web;


use App\Models\Review;
use App\Models\User;
use Inertia\Inertia;

class ReviewController extends WebBaseController
{

    public function forUser($id)
    {
        $data = Review::with([
            'to_user', 'from_user'
        ])->where('to_id', $id)
            ->paginate(10);

        $reviewedUser = User::findOrFail($id);

        return Inertia::render('Consultant/Reviews', [
            'data' => $data,
            'reviewedUser' => $reviewedUser
        ]);
    }
}