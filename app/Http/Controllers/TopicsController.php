<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TopicRepository;

class TopicsController extends Controller
{
    protected $topic;

    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }

    public function index(Request $request)
    {
        return $this->topic->getTopicsForTagging($request);
    }
}
