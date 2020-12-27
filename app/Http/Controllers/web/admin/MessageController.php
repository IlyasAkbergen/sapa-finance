<?php

namespace App\Http\Controllers\web\admin;

use App\Enums\ReferralLevelEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\web\WebBaseController;
use App\Http\Requests\MessageFormRequest;
use App\Models\Message;
use App\Models\User;
use App\Models\UserMessage;
use App\Services\AttachmentService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MessageController extends WebBaseController
{
    private $messageService;
    private $attachmentService;

    public function __construct(
        MessageService $messageService,
        AttachmentService $attachmentService
    )
    {
        $this->attachmentService = $attachmentService;
        $this->messageService = $messageService;
        $this->middleware('admin')
            ->except(['my', 'show', 'makeSeen']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $data = Message::with(['users', 'attachments'])
            ->paginate(10);
        return Inertia::render('Messages/Crud/Index', [
            'data'=> $data
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function my(Request $request)
    {
        $messages = Message::with('attachments')
            ->whereHas('users', function ($query) {
            return $query->where('user_id', Auth::user()->id);
        })
            ->orderBy('created_at')
            ->paginate(10);

        return Inertia::render('Messages/Index', [
            'messages'=> $messages
        ]);
    }

    public function makeSeen(Request $request)
    {
        $request->validate([
            'ids' => 'array'
        ]);


        UserMessage::where('user_id', Auth::user()->id)
            ->whereIn('message_id', $request->input('ids'))
            ->update([
                'seen' => true
            ]);

        return $this->responseSuccess('OK');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MessageFormRequest $request)
    {
        $message = $this->messageService->create(
            $request->only([
                'title',
                'content',
                'url',
                'levels'
            ])
        );

        if (!empty($message)) {

            $levels = collect($request->input('levels'));

            $users = User::whereIn('referral_level_id', $levels)
                        ->when($levels->contains(ReferralLevelEnum::Client), function ($q) {
                            return $q->orWhereNull('referral_level_id');
                        })
                        ->get();

            $message->users()->attach($users);

            $this->attachmentService->move($request->uuid, $message->id);

            return redirect()->route('messages.index');
        } else {
            return $this->responseFail('failed saving message');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->messageService->delete($id);

        UserMessage::where('message_id', $id)
            ->delete();

        if ($deleted) {
            return redirect()->route('messages.index');
        } else {
            return $this->responseFail('Не удалосьу удалить');
        }
    }
}
