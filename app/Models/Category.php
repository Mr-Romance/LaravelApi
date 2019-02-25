<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // 我不确定这种复数形式能找到，故指定表名称
    protected $table='categories';

    // 可以使用 create 方法批量赋值
    protected $fillable=[
        'name','description'
    ];

}
