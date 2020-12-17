<?php

namespace App\Http\Controllers\web\admin;

use App\Http\Controllers\web\WebBaseController;
use App\Models\Briefcase;
use App\Services\AttachmentService;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BriefcaseController extends WebBaseController
{
    private $briefcaseService;
    private $attachmentController;

    public function __construct(
        CourseService $courseService,
        AttachmentService $attachmentService
    )
    {
        $this->courseService = $courseService;
        $this->attachmentService = $attachmentService;
    }

    public function index(Request $request)
    {
        $data = Briefcase::where('title', 'like', "%$request->search_key%")
            ->paginate(10);

        return Inertia::render('Briefcase/Crud/Index', [
            'data' => $data
        ]);
    }
}
