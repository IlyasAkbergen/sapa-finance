<?php


namespace App\Http\Middleware;

use App\Http\Resources\MyCourseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    public function share(Request $request)
    {
        $request->user()->load('active_course.auth_user_pivot');
        return array_merge(parent::share($request), [
            'flash' => [
                'message' => function () use ($request) {
                    return $request->session()->get('message');
                },
                'sub_message' => function () use ($request) {
                    return $request->session()->get('sub_message');
                }
            ],
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
//            'active_course' => MyCourseResource::make($request->active_course)
//                    ->resolve(),
        ]);
    }
}
