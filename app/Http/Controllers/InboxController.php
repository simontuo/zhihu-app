<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MessageRepository;

class InboxController extends Controller
{
    protected $message;

    public function __construct(MessageRepository $message)
    {
        $this->middleware('auth');
        $this->message = $message;
    }

    public function index()
    {
        $messages = $this->message->getAllMessages();

        return view('inbox.index', ['messages' => $messages->groupBy('dialog_id')]);
    }

    public function show($dialogId)
    {
        $messages = $this->message->getDialogMessagesBy($dialogId);

        $messages->markAsRead();

        return view('inbox.show', compact('messages', 'dialogId'));
    }

    public function store($dialogId)
    {
        $message = $this->message->getSingleMessageBy($dialogId);

        $toUserId = $message->from_user_id === user()->id ? $message->to_user_id : $message->from_user_id;

        $this->message->create([
            'from_user_id' => user()->id,
            'to_user_id'   => $toUserId,
            'body'         => request('body'),
            'dialog_id'    => $dialogId
        ]);

        return back();
    }
}
