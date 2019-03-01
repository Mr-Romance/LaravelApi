<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    /**
     *  关联关系：topics 外键:user_id
     *  用户一对多话题
     *  一个话题属于一个用户
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * 关联关系: topics 外键：category_id
     * 分类一对多话题
     * 一个话题属于一个分类
     */
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     *  话题列表的分页数据
     *
     * @param int $page_size
     * @return mixed
     */
    public static function getTopicsList($page_size) {
        // 给默认页数赋值
        if (empty($page_size) || (int)$page_size <= 0) {
            $page_size = 15;
        }
        // 这里先使用简单分页
        $topics = Topic::paginate($page_size);

        return $topics;
    }
}
