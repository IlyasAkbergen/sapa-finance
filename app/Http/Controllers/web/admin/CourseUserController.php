<?php


namespace App\Http\Controllers\web\admin;


use App\Http\Controllers\web\WebBaseController;
use App\Models\Message;
use App\Models\UserBriefcase;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseUserController extends WebBaseController
{
    public function index(Request $request)
    {
        $data = UserCourse::where('paid', 0)
            ->with(['user', 'course'])
            ->paginate(20);

        $orders = $data->items();

        return Inertia::render('Courses/Orders', [
            'orders' => $orders,
            'data' => $data
        ]);
    }

    public function acceptOrder($id)
    {
        $order = UserCourse::with('course')
            ->findOrFail($id);

        if (data_get($order, 'status') != UserCourse::STATUS_ACCEPTED) {
            $data = [
                'status' => UserBriefcase::STATUS_ACCEPTED,
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
            'status' => UserBriefcase::STATUS_REJECTED
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
