<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     *  展示登录页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     *  用户登录
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // 校验参数
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|regex:/^1[34578][0-9]{9}$/',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return $this->errorResponse(self::VALIDATE_FAILED, $validator->errors()->first());
        }

        // 手机号及密码校验
        $login_user = User::wherePhone($request->input('phone'))->first();
        if (empty($login_user)) {
            return $this->errorResponse(self::DB_NOT_FOUND, '该用户不存在');
        }

        if (!Hash::check($request->input('password'), $login_user->password)) {
            return $this->errorResponse(self::DB_NOT_FOUND, '密码错误');
        }

        return $this->successResponse([], '登录成功');
    }
}
