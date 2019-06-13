<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Replay
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Replay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Replay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Replay query()
 * @mixin \Eloquent
 */
class Replay extends Model
{
    // 指定表名称
    protected $table = 'replay';

    protected $fillable = ['content'];

    /**
     *  一条话题有多个回复
     *  一个回复属于一个话题
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic() {
        return $this->belongsTo('App\Models\Topic');
    }

    public function fromUser() {
        return $this->belongsTo('App\Models\User', 'from_user', 'id');
    }

    public function toUser() {
        return $this->belongsTo('App\Models\User', 'to_user', 'id');
    }
}
