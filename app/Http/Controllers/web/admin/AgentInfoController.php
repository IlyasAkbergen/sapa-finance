<?php

namespace App\Http\Controllers\web\admin;

use App\Enums\ReferralLevelEnum;
use App\Http\Controllers\web\WebBaseController;
use App\Http\Resources\MyCourseResource;
use App\Models\Course;
use App\Models\Support;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AgentInfoController extends WebBaseController
{
    public function create()
    {
        return Inertia::render('AgentInfo/Add');
    }

    public function index()
    {
        $course = Course::where('tag', Course::START_COURSE_TAG)->first();

        if (empty($course) && !Auth::user()->isAdmin) {
            if (Auth::user()->referral_level_id < ReferralLevelEnum::Agent
                || empty(Auth::user()->referral_level_id)
            ) {
                Auth::user()->update([
                    'referral_level_id' => ReferralLevelEnum::Agent
                ]);
            }
            return redirect()->route('me');
        }

        return Inertia::render('AgentInfo/Show', [
            'agent_info' => $course
                ? MyCourseResource::make($course)->resolve()
                : null,
        ]);
    }

    public function edit($id)
    {

    }

    public function destroy($id)
    {
        Course::where('tag', Course::START_COURSE_TAG)->delete();

        return redirect()->route('agent-info.index');
    }
}
