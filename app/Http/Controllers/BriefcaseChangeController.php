<?php

namespace App\Http\Controllers;

use App\Http\Requests\BriefcaseRequest;
use App\Models\BriefcaseChange;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BriefcaseChangeController extends Controller
{
    public function index(Request $request)
    {
        $data = BriefcaseChange::query() //where('status', BriefcaseChange::STATUS_CREATED)
            ->when($request->has('partner_id'), function ($q) use ($request) {
                $q->where('partner_id', data_get($request, 'partner_id'));
            })
            ->with('briefcase')
            ->orderByDesc('created_at')
            ->get();

        return Inertia::render('Programs/Changes/Index', [
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $change = BriefcaseChange::with('briefcase', 'partner')
            ->findOrFail($id);

        return Inertia::render('Programs/Changes/Show', [
            'change' => $change,
            'briefcase' => data_get($change, 'briefcase'),
            'partner' => data_get($change, 'partner')
        ]);
    }

    public function apply($id)
    {
        $change = BriefcaseChange::with('briefcase', 'partner')
            ->findOrFail($id);
        $action_text = '';
        switch (data_get($change, 'type_id')) {
            case BriefcaseChange::TYPE_CREATE:
                $change->briefcase->restore();
                $action_text = 'добавление';
                break;
            case BriefcaseChange::TYPE_EDIT:
                $change->briefcase->update(
                    data_get($change, 'change_data')
                );
                $action_text = 'изменение';
                break;
            case BriefcaseChange::TYPE_DELETE:
                $change->briefcase->delete();
                $action_text = 'удаление';
                break;
            default: break;
        }

        $change->update([
           'status' => BriefcaseChange::STATUS_ACCEPTED
        ]);

        $message = Message::create([
            'title' => 'Заявка на ' . $action_text . ' программы принята.',
            'content' => 'Админ принял ' . $action_text . ' программы: "'
                . data_get($change, 'briefcase.title') . '"',
            'url' => route('programs-crud.show', data_get($change, 'briefcase_id')),
            'is_public' => false
        ]);

        $message->users()->attach(data_get($change, 'partner_id'));

        return redirect()->back();
    }

    public function reject($id)
    {
        $change = BriefcaseChange::with('briefcase', 'partner')
            ->findOrFail($id);

        $change->update([
            'status' => BriefcaseChange::STATUS_REJECTED
        ]);

        $message = Message::create([
            'title' => 'Заявка по программе отклонена.',
            'content' => 'Админ отклонил изменения по программе: "'
                . data_get($change, 'briefcase.title') . '"',
            'url' => route('programs-crud.show', data_get($change, 'briefcase_id')),
            'is_public' => false
        ]);

        $message->users()->attach(data_get($change, 'partner_id'));

        return redirect()->back();
    }
}
