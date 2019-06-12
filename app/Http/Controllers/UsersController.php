<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandlers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     *  显示用户信息页
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user) {
        /*
         * 用到概念：路由模型绑定（隐式绑定）
         *
         *  如果在数据库中找不到对应的模型实例，将会自动生成 404 异常
         */

        // 获取该用户下的所有话题
        $topics = $user->topics()->paginate(config('variable.default_pagesizes'));

        return view('users.show', compact('user', 'topics'));
    }

    /**
     *  显示编辑用户页面
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditUser(User $user) {
        return view('users.editUser', compact('user'));
    }

    /**
     *  编辑用户
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editUser(Request $request) {
        /**
         * @var User $user
         */
        if (!Auth::user()) {
            return $this->errorResponse(self::NOTAUTHED, '用户没有登录认证');
        }

        // 获取当前已经认证的用户
        $user = Auth::user();

        // 参数校验
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'phone' => 'required|regex:/^1[34578][0-9]{9}$/',
            'email' => 'required|string|email',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse(self::VALIDATE_FAILED, $validator->errors()->first());
        }

        // 保存用户的头像
        $head_portrait = '';
        if ($request->file('head_portrait') && $request->file('head_portrait')->isValid()) {
            try {
                $img_name = time() . '_' . $user->id;
                $head_portrait = ImageUploadHandlers::storageImg($request->file('head_portrait'), 'head_portrait', $img_name);
            } catch (\Exception $exception) {
                return $this->errorResponse(self::FILE_STORAGE_FAILED, $exception->getMessage());
            }
        }

        // 手机、邮箱唯一性检查
        $phone_exists = User::where([['phone', '=', $request->input('phone')], ['id', '<>', $user->id]])->exists();
        if ($phone_exists) {
            return $this->errorResponse(self::DB_DATA_EXISTS, '该手机号已经存在');
        }
        $email_exists = User::where([['email', '=', $request->input('email')], ['id', '<>', $user->id]])->exists();
        if ($email_exists) {
            return $this->errorResponse(self::DB_DATA_EXISTS, '该邮箱已经存在');
        }

        /**
         * @var User $user
         */
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        if ($head_portrait) {
            $user->head_portrait = $head_portrait;
        }
        if (!$user->save()) {
            return $this->errorResponse(self::DB_UPD_FAILED, '更新用户信息失败');
        }

        return $this->successResponse(['user_id' => $user->id], '更新成功');
    }

}
