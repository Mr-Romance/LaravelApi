<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Topic
 *
 * @method static paginate(int $page_size)
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $user_id
 * @property int $category_id
 * @property int $reply_count
 * @property int $view_count
 * @property int $last_reply_user_id
 * @property int $order
 * @property string|null $excerpt
 * @property string|null $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereLastReplyUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereReplyCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Topic whereViewCount($value)
 * @mixin \Eloquent
 */
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
     * @param array $query_data
     * @return mixed
     */
    public static function getTopicsList($page_size, $query_data=[]) {
        // 给默认页数赋值
        if (empty($page_size) || (int)$page_size <= 0) {
            $page_size = 15;
        }
        $topics = [];
        if (empty($query_data)) {
            // 这里先使用简单分页
            $topics = Topic::paginate($page_size);
        } else { // 拼接查询条件
            if (!empty($query_data['category_id'])) {
                $topics = Topic::where('category_id', $query_data['category_id'])->paginate($page_size);
            }
        }

        return $topics;
    }
}
