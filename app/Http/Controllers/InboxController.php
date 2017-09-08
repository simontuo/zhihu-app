<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class InboxController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $messages = Message::where('to_user_id', user()->id)
            ->orWhere('from_user_id', user()->id)
            ->with(['fromUser', 'toUser'])
            ->get();

        return view('inbox.index', ['messages' => $messages->groupBy('to_user_id')]);
    }

    public function show($dialogId)
    {
        $messages = Message::where('dialog_id', $dialogId)->get();

        return $messages;
    }
}
