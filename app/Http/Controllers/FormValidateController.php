<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 *  通用的表单验证类（我不想再控制器中看到这些重复但又不相同的代码）
 *
 * Class FormValidateController
 * @package App\Http\Controllers
 */
trait FormValidateController
{
    /**
     *  用户注册表单验证
     *
     * @param Request $request
     * @return mixed
     */
    public function validate_register_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6',
            'password' => 'required|string|min:6|max:30|confirmed',
            'phone' => 'required|string|regex:/^1[34578][0-9]{9}$/',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(self::VALIDATE_FAILED, $validator->errors()->first());
        }
    }

    /**
     *  用户编辑信息
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validate_edit_user(Request $request)
    {
        $err_msg = [
            'user_id.required' => '用户id非空',
            'name.required' => '用户名非空',
            'email.required' => '邮箱地址非空'
        ];

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|string',
            'img' => 'string'
        ], $err_msg);

        if ($validator->fails()) {
            return $this->errorResponse(self::VALIDATE_FAILED, $validator->errors()->first());
        }
    }

    /**
     *  用户登录验证
     *
     * @param Request $request
     * @return mixed
     */
    public function validate_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|regex:/^1[34578][0-9]{9}$/',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }
    }

}
