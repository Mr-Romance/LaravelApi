<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     *  话题列表页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function topicsList() {
        $topics = Topic::getTopicsList(config('variable.topics_pageisze'));
        return view('topics.topicsList', compact('topics'));
    }

}
