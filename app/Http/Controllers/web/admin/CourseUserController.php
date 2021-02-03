<?php


namespace App\Http\Controllers\web\admin;


use App\Http\Controllers\web\WebBaseController;
use App\Http\Resources\MyCourseResource;
use App\Models\Message;
use App\Models\User;
use App\Models\UserCourse;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseUserController extends WebBaseController
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index(Request $request)
    {
        $data = UserCourse::where('paid', 0)
            ->with(['user', 'course'])
            ->when($request->has('user_id'), function ($q) use ($request) {
                return $q->where('user_id', data_get($request, 'user_id'));
            })
            ->paginate(20);

        $orders = $data->items();

        return Inertia::render('Courses/Orders', [
            'orders' => $orders,
            'data' => $data
        ]);
    }

    public function ofUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $courses = $this->courseService
            ->ofUser($user)
            ->filter(function ($item) {
                return data_get($item, 'pivot.status') == UserCourse::STATUS_ACCEPTED;
            });

        return Inertia::render('Courses/MyCourses', [
            'courses' => MyCourseResource::collection($courses)
                                         ->resolve()
        ]);
    }

    public function acceptOrder($id)
    {
        $order = UserCourse::with('course')
            ->findOrFail($id);

        if (data_get($order, 'status') != UserCourse::STATUS_ACCEPTED) {
            $data = [
                'status' => UserCourse::STATUS_ACCEPTED,
                'paid' => true
            ];

            $order->update($data);

            $message = Message::create([
                'title' => 'Заявка на курс подтверждена',
                'content' => 'Админ подтвердил Вашу заявку на курс "'
                    . data_get($order, 'course.title') . '"',
                'url' => route('my-courses'),
                'is_public' => false
            ]);

            $message->users()->attach(data_get($order, 'user_id'));
        }

        return redirect()->back();
    }

    public function rejectOrder($id)
    {
        $order = UserCourse::with('course')
            ->findOrFail($id);

        $data = [
            'status' => UserCourse::STATUS_REJECTED
        ];

        $order->update($data);

        $message = Message::create([
            'title' => 'Заявка на курс отклонена.',
            'content' => 'Админ отклонил Вашу заявку на курс "'
                . data_get($order, 'course.title') . '"',
            'url' => null,
            'is_public' => false
        ]);

        $message->users()->attach(data_get($order, 'user_id'));

        return redirect()->back();
    }

    public function delete($id)
    {
        $order = UserCourse::with('purchase')->find($id);

        if ($purchase = data_get($order, 'purchase')) {
            $purchase->delete();
        }

        $order->delete();

        return redirect()
            ->back()
            ->with([
                'message' => 'Удалено.'
            ]);
    }
}
