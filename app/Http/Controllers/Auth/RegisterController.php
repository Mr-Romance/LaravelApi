<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     *  用户注册
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // 参数校验
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'password' => 'required|string|min:6|max:30|confirmed',
            'phone' => 'required|string|regex:/^1[34578][0-9]{9}$/',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(self::VALIDATE_FAILED, $validator->errors()->first());
        }

        $phone = $request->input('phone');
        $name = $request->input('name');
        $password = $request->input('password');
        $email = $request->input('email');

        // 检查重复插入
        if (User::wherePhone($phone)->exists()) {
            return $this->errorResponse(self::DB_DATA_EXISTS, '手机号已经存在');
        }
        if (User::whereEmail($email)->exists()) {
            return $this->errorResponse(self::DB_DATA_EXISTS, '该邮箱已经存在');
        }
        if (User::whereName($name)->exists()) {
            return $this->errorResponse(self::DB_DATA_EXISTS, '用户名已经存在');
        }

        $user = new User();
        $user->name = $name;
        $user->phone = $phone;
        $user->password = Hash::make($password);
        $user->email = $email;

        if (!$user->save()) {
            return $this->errorResponse(self::DB_SAVE_FAILED, '添加注册信息失败');
        }

        return $this->successResponse([], '注册成功');
    }

    /**
     *  显示用户注册窗口
     *
     * @return mixed
     */
    public function showRegister()
    {
        return view('auth.register');
    }
}
