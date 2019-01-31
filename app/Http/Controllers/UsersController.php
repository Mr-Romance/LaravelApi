<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersController extends Controller
{
    /**
     *  显示用户信息页
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        // 用到概念：路由模型绑定（隐式绑定）
        return view('users.show', compact('user'));
    }

    /**
     *  显示编辑用户页面
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditUser(User $user)
    {
        return view('users.editUser', compact('user'));
    }

    /**
     *  编辑用户
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editUser(Request $request)
    {
        // 参数校验
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|string|min:3',
            'phone' => 'required|regex:/^1[34578][0-9]{9}$/',
            'email' => 'required|string|email',
            'new_password' => 'required|string|confirmed',
            'head_portrait' => 'string'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }

        // 手机、邮箱唯一性检查
        $phone_exists = User::where([
            [ 'phone', '=', $request->input('phone') ],
            [ 'id', '<>', $request->input('id') ]
        ])->exists();
        if ($phone_exists) {
            return $this->errorResponse(self::DB_DATA_EXISTS, '该手机号已经存在');
        }
        $email_exists = User::where([
            [ 'email', '=', $request->input('email') ],
            [ 'id', '<>', $request->input('id') ]
        ])->exists();
        if ($email_exists) {
            return $this->errorResponse(self::DB_DATA_EXISTS, '该邮箱已经存在');
        }

        $user = User::find($request->input('1'));
        /**
         * @var User $user
         */
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = Hash::make($request->input('new_password'));
        if (!empty($request->input('head_portrait'))) {
            $user->head_portrait = $request->input('head_portrait');
        }
        if (!$user->save()) {
            return $this->errorResponse(self::DB_UPD_FAILED, '更新用户信息失败');
        }

        return $this->successResponse([], '更新成功');
    }

    /**
     *  增加users表中的列
     */
    public function upd_users_table()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('remember_token')->nullable();
        });
    }
}
