<?php

namespace App\Http\Controllers;

use App\Jobs\DuiLieDemo;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        var_dump($topics);
//        return view('topics.topicsList', compact('topics'));
    }

    /**
     *  显示 添加、编辑页面
     *
     * @param Topic $topic
     */
    public function showAdd(Topic $topic) {
        $categories = Category::all();

    }

    /**
     *  添加、编辑话题
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request) {
        $params = $request->all();
        if (empty($params)) {
            return $this->errorResponse(self::VALIDATE_FAILED, '保存参数为空');
        }

        // 参数校验
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3',
            'body' => 'required|string|min:3',
            'category_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse(self::VALIDATE_FAILED, $validator->errors()->first());
        }

        try {
            $topic_model=Topic::addTopic($params);

            // 使用队列处理sulg字段
            DuiLieDemo::setter($topic_model->id);
            DuiLieDemo::dispatch();

        } catch (\Exception $exception) {
            return $this->errorResponse(self::DB_SAVE_FAILED, $exception->getMessage());
        }

        return $this->successResponse([], '操作成功');
    }
}
