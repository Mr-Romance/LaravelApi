<?php
/**
 *  图片上传的辅助类
 */

namespace App\Handlers;

use Illuminate\Http\UploadedFile;

class ImageUploadHandlers
{
    /**
     *  通用的保存图片的方法
     *
     * @param UploadedFile $file
     * @param string $file_path
     * @param string $file_name
     * @return false|string
     * @throws \Exception
     */
    public static function storageImg($file, $file_path, $file_name)
    {
        $base_path = 'img/';

        // 必须制定本次上传的目录
        if (empty($file_path)) {
            throw new \Exception('请指定文件上传的目录名');
        }

        // 保证图片必须有一个后缀
        $img_extension = !empty($file->extension()) ? $file->extension() : 'png';
        if (!in_array($img_extension, [ 'jpeg', 'bmp', 'png' ])) {
            throw new \Exception('文件后缀不合法');
        }

        // 拼接完整的文件路径
        $full_file_path = $base_path . $file_path;
        $file_name = $file_name . $img_extension;

        // 保存图片
        $ret_path = $file->storeAs($full_file_path, $file_name);
        if (!$ret_path) {
            throw new \Exception('保存文件失败');
        }

        // 返回上传文件的路径，注意文件路径的映射关系
        return $ret_path;
    }
}