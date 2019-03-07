<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     *  话题列表页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function topicsList(Request $request) { // 可选参数，一定要有默认值
        $query_data = $request->all();
        $topics = Topic::getTopicsList(config('variable.topics_pageisze'), $query_data);
        return view('topics.topicsList', compact('topics'));
    }

}
