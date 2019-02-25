<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table='topics';

    /**
     *  关联关系：topics 外键:user_id
     *  用户一对多话题
     *  话题属于一个用户
     */
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    /**
     * 关联关系: topics 外键：category_id
     * 分类一对多话题
     * 话题属于一个分类
     */
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

}
