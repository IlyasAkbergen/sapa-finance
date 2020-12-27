<?php

use App\Http\Controllers\web\admin\MessageController;
use App\Http\Controllers\web\admin\PartnerController;
use App\Http\Controllers\web\admin\PenaltyController;
use App\Http\Controllers\web\admin\UserController;
use App\Http\Controllers\web\ArticleController;
use App\Http\Controllers\web\AttachmentController;
use App\Http\Controllers\web\BriefcaseController as ClientBriefcaseController;
use App\Http\Controllers\web\admin\BriefcaseController as AdminBriefcaseController;
use App\Http\Controllers\web\admin\ConsultantController as ConsultantAdminController;
use App\Http\Controllers\web\ComplaintController;
use App\Http\Controllers\web\CourseController;
use App\Http\Controllers\web\admin\CourseController as CourseCrudController;
use App\Http\Controllers\web\admin\LessonController as LessonCrudController;
use App\Http\Controllers\web\HomeworkController;
use App\Http\Controllers\web\LessonController;
use App\Http\Controllers\web\PayoutController;
use App\Http\Controllers\web\PurchaseController;
use App\Http\Controllers\web\ReferralController;
use App\Http\Controllers\web\SaleController;
use App\Http\Controllers\web\SupportController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\web\AuthController::class, 'index'])
    ->middleware(['guest'])->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::resource(
    '/articles',
    ArticleController::class
);

Route::group(['middleware' => [
    'auth:sanctum',
    'share.inertia',
    'client',
    'verified'
]], function () {
    Route::resource('courses', CourseController::class);

    Route::get(
        'my-courses',
        [CourseController::class, 'my']
    )->name('my-courses');

    Route::resource('briefcases', ClientBriefcaseController::class);

    Route::get('/my-briefcases', [ClientBriefcaseController::class, 'my'])
        ->name('my-briefcases');

    Route::get(
        '/briefcase/{id}/add', [ClientBriefcaseController::class, 'attachToMe']
    )->name('attach_briefcase');

    Route::resource(
        'purchases',
        PurchaseController::class
    );

    Route::resource(
        'payouts',
        PayoutController::class
    );

    Route::get(
        '/pay/success',
        function () {
            return redirect()->route('my-purchases');
        }
    );

    Route::get(
        '/my-purchases',
        [PurchaseController::class, 'my']
    )->name('my-purchases');

    Route::post('/payout/success', function () {
        return redirect('balance');
    });

    Route::get(
        '/my-referrals',
        [ReferralController::class, 'myReferrals']
    )->name('my-referrals');

    Route::resource('sales', SaleController::class);

    Route::resource('support', SupportController::class);

    Route::get('notifications', [MessageController::class, 'my'])->name('my_notify');

    Route::resource(
        'attachments',
        AttachmentController::class
    )->withoutMiddleware('client');

    Route::post(
        'attachments/list',
        [AttachmentController::class, 'list']
    )->withoutMiddleware('client');

    Route::post('/complaints', [ComplaintController::class, 'store'])
        ->name('complaints.store');

    Route::resource('lessons', LessonController::class);

    Route::get('/courses/{id}/next_lesson/{lesson_id}', [LessonController::class, 'next'])
        ->name('next_lesson');

    Route::get('/courses/{id}', [LessonController::class, 'show'])
        ->name('courses');
    Route::get('/agent', [CourseController::class, 'getStarterCourseAgent'])
        ->name('starter_lesson');
    Route::put('/lessons/{id}/submit_homework');
    Route::resource(
        'homeworks',
        HomeworkController::class
    )
    ->withoutMiddleware('client')
    ->middleware('rates_homework');

    Route::post(
        '/rate-homework',
        [HomeworkController::class, 'rate']
    )
    ->middleware('rates_homework')
    ->withoutMiddleware('client');

    Route::get('/users-crud/me', [UserController::class, 'me'])->name('me');
    Route::put('/users-crud/update/{id}', [UserController::class, 'update'])->name('update');
    Route::get(
        '/complaints/create/{id}/{referrer_id}',
        [ComplaintController::class, 'create']
    )->name('complaints.create');

    Route::post('/complaints-crud', [ComplaintController::class, 'store']);

    Route::post('/make-messages-seen', [
        MessageController::class,
        'makeSeen'
    ])
    ->withoutMiddleware('client')
    ->name('make_seen');
});

Route::group(['middleware' => [
    'auth:sanctum',
    'share.inertia',
    'admin'
]], function () {

    Route::get(
        '/users/{id}/complaints',
        [ComplaintController::class, 'forUser'])
        ->name('user_complaints')
    ;

    Route::resource('courses-crud', CourseCrudController::class);
    Route::post('courses-crud/upload-image',
        [CourseCrudController::class, 'uploadImage']
    )->name('upload-course-image');

    Route::post('courses-crud/upload-attachments',
        [CourseCrudController::class, 'uploadAttachments']
    )->name('upload-course-attachments');

    Route::get(
        '/courses-stats',
        [CourseCrudController::class, 'stats']
    )->name('courses-stats');

    Route::resource('briefcases-admin', AdminBriefcaseController::class);

    Route::resource('lessons-crud', LessonCrudController::class);
    Route::post('courses-crud/upload-image',
        [CourseCrudController::class, 'uploadImage']
    )->name('upload-course-image');

    Route::resource('partners-crud', PartnerController::class);
    Route::resource('users-crud', UserController::class);

    Route::get('/complaints', [ComplaintController::class, 'index'])
        ->name('complaints.index');

    Route::delete('/complaints/{id}', [ComplaintController::class, 'destroy'])
        ->name('complaints-crud.destroy');

    Route::post('/penalty', [PenaltyController::class, 'store']);

    Route::resource('messages', MessageController::class);

    Route::resource('consultants-crud', ConsultantAdminController::class);
});

Route::get('/test', function () {
//    $user = User::with('balance')->findOrFail(5);
//
//    if ($user->referral_level_id == ReferralLevelEnum::Partner) {
//        return;
//    }
//
//    $next_level_id = empty($user->referral_level_id)
//        ? ReferralLevelEnum::Agent
//        : $user->referral_level_id + 1;
//
//    $next_level = ReferralLevel::findOrFail($next_level_id);
//
//    $deservesLevelUp = true;
//
//    foreach ($next_level->achieve_challenges as $challenge) {
//        $deservesLevelUp = $deservesLevelUp && $challenge::check($user);
//    }
//
//    if ($deservesLevelUp) {
//        $user->updateReferralLevel($next_level_id);
//    }
});
