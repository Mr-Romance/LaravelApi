<?php
/**
 * 开发过程中，修改数据库的操作，列的增加修改、初始数据填充等
 * 上线后会删除该文件，只在开发过程中使用，为了统一管理现在放在这里
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class DBHelperController
{

    /**
     *  categories 表插入初始数据
     */
    public function seed_category() {
        $categories = [
            ['name' => '分享', 'description' => '技能、知识、感悟'],
            ['name' => '教程', 'description' => '开发技巧、拓展包使用等'],
            ['name' => '问答', 'description' => '互相帮助'],
            ['name' => '公告', 'description' => '站点公告']
        ];

        if (DB::table('categories')->insert($categories)) {
            var_dump('插入成功');
        } else {
            var_dump('插入失败');
        }
    }
}