<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // 可以使用 create 方法批量赋值
    protected $fillable=[
        'name','description'
    ];

}
