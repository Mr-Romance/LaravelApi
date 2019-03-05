<?php

namespace App\Models;

use Exception;
use function GuzzleHttp\Promise\is_settled;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    // 我不确定这种复数形式能找到，故指定表名称
    protected $table = 'categories';

    // 可以使用 create 方法批量赋值
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * 根据主键获取分类的信息
     *
     * @param int $category_id
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws Exception
     */
    public static function getModelById($category_id) {
        $category = Category::find($category_id);
        if (!$category) {
            throw new Exception('获取分类信息失败');
        }

        return $category;
    }

    /**
     *  获取分类信息
     *
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    static $_categories;

    public static function getAllCategories() {
        if (empty(self::$_categories) || !isset(self::$_categories)) {
            self::$_categories = Category::all();
        }

        return self::$_categories;
    }
}
