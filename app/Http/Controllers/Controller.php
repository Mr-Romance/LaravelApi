<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use FormValidateController;

    // 正常返回
    const SUCCESS = 100;

    // 魔术错误返回（不推荐）
    const FAILED = 200;

    // 数据库异常操作
    const DB_NOT_FOUND = 301;
    const DB_DATA_EXISTS = 302;
    const DB_UPD_FAILED = 303;
    const DB_SAVE_FAILED = 304;
    const DB_DEL_FAILED = 305;

    // 参数校验错误
    const VALIDATE_FAILED = 401;


    /**
     *  成功的返回
     * @param string $msg
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse(array $data, $msg = '操作成功')
    {
        return response()->json(['http_code' => 200, 'code' => self::SUCCESS, 'msg' => $msg, 'data' => $data]);
    }

    /**
     *  失败的返回
     * @param string $msg
     * @param int $err_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse(int $err_code, $msg = '操作失败')
    {
        return response()->json(['http_code' => 200, 'code' => $err_code, 'msg' => $msg]);
    }
}
