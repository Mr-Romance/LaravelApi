<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{

    /**
     *  根据分类id获取话题列表
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
    public function getTopics(Request $request) {
        // 参数校验
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(self::VALIDATE_FAILED, $validator->errors()->first());
        }

        // 获取并返回数据
        $topics = Topic::getTopicsList(config('variable.topics_pagesize'), $request->all());
        try {
            $category = Category::getModelById($request->input('category_id'));
        } catch (\Exception $e) {
            return $this->errorResponse(self::DB_DATA_EXISTS, $e->getMessage());
        }

        return view('topics.topicsList', compact('topics', 'category'));
    }
}

