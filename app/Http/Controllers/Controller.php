<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\FormValidateController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use FormValidateController;

    /**
     *  成功的返回
     * @param string $msg
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse(array $data, $msg = '操作成功')
    {
        return response()->json(['http_code' => 200, 'code' => 1000, 'msg' => $msg, 'data' => $data]);
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
