<?php

use App\Http\Controllers\BriefcaseChangeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\web\admin\AgentInfoController;
use App\Http\Controllers\web\admin\CourseUserController;
use App\Http\Controllers\web\admin\MessageController;
use App\Http\Controllers\web\admin\PartnerController;
use App\Http\Controllers\web\admin\PenaltyController;
use App\Http\Controllers\web\admin\UserController;
use App\Http\Controllers\web\ArticleController;
use App\Http\Controllers\web\AttachmentController;
use App\Http\Controllers\web\BriefcaseController as ClientBriefcaseController;
use App\Http\Controllers\web\admin\BriefcaseController as AdminBriefcaseController;
use App\Http\Controllers\web\admin\ConsultantController as ConsultantAdminController;
use App\Http\Controllers\web\admin\SupportController as AdminSupportController;
use App\Http\Controllers\web\ComplaintController;
use App\Http\Controllers\web\CourseController;
use App\Http\Controllers\web\admin\CourseController as CourseCrudController;
use App\Http\Controllers\web\admin\LessonController as LessonCrudController;
use App\Http\Controllers\web\HomeworkController;
use App\Http\Controllers\web\LessonController;
use App\Http\Controllers\web\partner\CabinetController;
use App\Http\Controllers\web\partner\PartnerUserController;
use App\Http\Controllers\web\partner\ProgramsController;
use App\Http\Controllers\web\PaymentController;
use App\Http\Controllers\web\PayoutController;
use App\Http\Controllers\web\PurchaseController;
use App\Http\Controllers\web\ReferralController;
use App\Http\Controllers\web\ReviewController;
use App\Http\Controllers\web\SaleController;
use App\Http\Controllers\web\SupportController;
use App\Models\Role;
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
Route::post('/', function () {
    return redirect()->route('my-courses');
});

Route::get('/', function () {
    return redirect()->route('welcome');
});

Route::group([
    'middleware' => 'guest',
    'prefix' => 'guest'
], function () {
   Route::get('/', [\App\Http\Controllers\web\AuthController::class, 'index'])
       ->name('welcome');

   Route::get('/course/{id}', [Controller::class, 'showCourse'])
        ->name('guest_course');

   Route::get('/article/{id}', [Controller::class, 'showArticle'])
        ->name('guest_article');

   Route::get('/consultant/{id}', [Controller::class, 'showConsultant'])
       ->name('guest_consultant');
});


Route::group(['middleware' => [
    'auth:sanctum',
]], function () {


    Route::resource(
        '/articles',
        ArticleController::class
    );


    Route::middleware(['verified'])->get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    Route::group(['middleware' => ['share.inertia',]], function () {

        Route::group(['middleware' => ['verified']], function () {

            Route::get('/users-crud/me', [UserController::class, 'me'])->name('me');

            Route::put('/users-crud/update/{id}', [UserController::class, 'update'])->name('update');

            Route::resource(
                'attachments',
                AttachmentController::class
            );

            Route::post(
                'attachments/list',
                [AttachmentController::class, 'list']
            );

            Route::resource(
                'briefcases',
                ClientBriefcaseController::class
            );

            Route::get('notifications', [MessageController::class, 'my'])
                ->name('my_notify');

            Route::resource(
                'homeworks',
                HomeworkController::class
            );

            Route::post(
                '/rate-homework',
                [HomeworkController::class, 'rate']
            )->middleware('rates_homework');

            Route::get('/users/{id}', [UserController::class, 'show'])
                ->name('users.show');

            Route::post('/make-messages-seen', [
                MessageController::class,
                'makeSeen'
            ])->name('make_seen');


            Route::group(['middleware' => ['client']], function () {


                Route::resource('courses', CourseController::class);

                Route::get(
                    'my-courses',
                    [CourseController::class, 'my']
                )->name('my-courses');

                Route::get('/my-briefcases', [ClientBriefcaseController::class, 'my'])
                    ->name('my-briefcases');

                Route::post(
                    '/briefcase/add', [ClientBriefcaseController::class, 'attachToMe']
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

                Route::post('/complaints', [ComplaintController::class, 'store'])
                    ->name('complaints.store');

                Route::resource('lessons', LessonController::class);

                Route::get('/courses/{id}/next_lesson/{lesson_id}', [LessonController::class, 'next'])
                    ->name('next_lesson');

                Route::get('/courses/{id}', [LessonController::class, 'show'])
                    ->name('courses');

                Route::get('/agent', [AgentInfoController::class, 'index'])
                    ->name('starter_lesson');

                Route::put('/lessons/{id}/submit_homework');

                Route::get(
                    '/complaints/create/{id}/{referrer_id}',
                    [ComplaintController::class, 'create']
                )->name('complaints.create');

                Route::post('/complaints-crud', [ComplaintController::class, 'store']);

                Route::resource('/payments', PaymentController::class);

                Route::get('/my-payments', [PaymentController::class, 'my'])
                    ->name('payments.my');


            });

        });


        Route::group(['middleware' => ['admin']], function () {


            Route::get(
                '/users/{id}/reviews',
                [ReviewController::class, 'forUser'])
                ->name('user_reviews');

            Route::get('/supports', [AdminSupportController::class, 'index'])->name('supports.index');

            Route::delete('/supports/{id}', [AdminSupportController::class, 'destroy'])->name('supports.destroy');

            Route::resource('courses-crud', CourseCrudController::class);

            Route::post('courses-crud/upload-image',
                [CourseCrudController::class, 'uploadImage']
            )->name('upload-course-image');

            Route::post('courses-crud/upload-attachments',
                [CourseCrudController::class, 'uploadAttachments']
            )->name('upload-course-attachments');

            Route::get(
                'user-courses/{id}',
                [CourseUserController::class, 'ofUser']
            )->name('admin.user-courses');

            Route::get(
                'course-orders',
                [CourseUserController::class, 'index']
            )->name('admin.course-orders');

            Route::put(
                '/course-order/accept/{id}',
                [CourseUserController::class, 'acceptOrder']
            );

            Route::put(
                '/course-order/reject/{id}',
                [CourseUserController::class, 'rejectOrder']
            );

            Route::delete(
                '/course-order/{id}',
                [CourseUserController::class, 'delete']
            );

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

            Route::get('users-referral-tree', [UserController::class, 'referralTree'])
                ->name('users-referral-tree');


            Route::get('/complaints', [ComplaintController::class, 'index'])
                ->name('complaints.index');

            Route::delete('/complaints/{id}', [ComplaintController::class, 'destroy'])
                ->name('complaints-crud.destroy');

            Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])
                ->name('reviews-crud.destroy');

            Route::post('/penalty', [PenaltyController::class, 'store']);

            Route::post('/change-referral', [ComplaintController::class, 'changeReferral']);

            Route::resource('messages', MessageController::class);

            Route::resource('consultants-crud', ConsultantAdminController::class);

            Route::get(
                'briefcase-orders',
                [PartnerUserController::class, 'orders']
            )->name('admin.briefcase-orders');

            Route::put(
                '/user-briefcase/accept/{id}',
                [PartnerUserController::class, 'acceptOrder']
            );

            Route::put(
                '/user-briefcase/reject/{id}',
                [PartnerUserController::class, 'rejectOrder']
            );

            Route::delete(
                '/user-briefcase/{id}',
                [PartnerUserController::class, 'deleteOrder']
            );

            Route::get(
                'user-briefcase-payments',
                [PartnerUserController::class, 'payments']
            )->name('user-briefcase-payments');

            Route::resource('agent-info', AgentInfoController::class);
        });


        Route::post('user-referrer-change', [UserController::class, 'changeReferrer'])
            ->name('user-referrer-change');


        Route::group(['middleware' => ['roles:' . Role::ROLE_ADMIN . ',' . Role::ROLE_PARTNER,]], function () {


            Route::get('/partner-cabinet', [CabinetController::class, 'index'])
                ->name('partner-cabinet.index');
            Route::get('/partner-cabinet/edit', [CabinetController::class, 'edit'])
                ->name('partner-cabinet.edit');
            Route::post('/partner-cabinet/update', [CabinetController::class, 'update']);
            Route::get(
                '/programs/create/{id}',
                [ProgramsController::class, 'create']
            )->name('programs.create');
            Route::resource('/programs-crud', ProgramsController::class);

//    Route::resource(
//        'partner-users',
//        PartnerUserController::class
//    );

            Route::get(
                'partner-user-active-briefcases',
                [PartnerUserController::class, 'activeOrders']
            )->name('partner-users.deals');

            Route::get(
                'partner-users-order/create',
                [PartnerUserController::class, 'createOrder']
            )->name('partner-users-order.create');

            Route::get(
                'partner-users-order/{id}/edit',
                [PartnerUserController::class, 'editOrder']
            )->name('partner-users-order.edit');

            Route::post(
                '/partner-user-order/update',
                [PartnerUserController::class, 'updateOrder']
            )->name('partner-users-order.update');

            Route::post(
                '/partner-user-order',
                [PartnerUserController::class, 'storeOrder']
            )->name('partner-users-order.store');

            Route::get(
                'user-briefcase-payments',
                [PartnerUserController::class, 'payments']
            )->name('partner-users.payments');

            Route::post(
                'partner-user-payment',
                [PartnerUserController::class, 'storePayment']
            );

            Route::delete(
                'partner-user-payment/{id}',
                [PartnerUserController::class, 'deletePayment']
            )->name('deletePayment');

            Route::get(
                'partner-stats',
                [PartnerUserController::class, 'partnerStats']
            )->name('partner-stats');

            Route::resource(
                'briefcase-change',
                BriefcaseChangeController::class
            );

            Route::get(
                'briefcase-change/{id}/apply',
                [BriefcaseChangeController::class, 'apply']
            )->name('apply-briefcase-change');

            Route::get(
                'briefcase-change/{id}/reject',
                [BriefcaseChangeController::class, 'reject']
            )->name('reject-briefcase-change');


        });

    });


});
