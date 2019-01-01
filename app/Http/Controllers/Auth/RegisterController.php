<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        // 参数校验
        $this->registerUser($request);

        $phone=$request->input('phone');
        $name=$request->input('name');
        $password=$request->input('password');
        $email=$request->input('email');

        // 检查重复插入
        if(User::wherePhone($phone)){
            return $this->errorResponse(301,'手机号已经存在');
        }
        if(User::whereName($name)){
            return $this->errorResponse(301,'用户名已经存在');
        }

        $user=new User();
        $user->name=$name;
        $user->phone=$phone;
        $user->password=bcrypt($password);
        $user->email=$email;
        $user->portrait=''; // 没有设置 nullable 这种情况单独处理

        if(!$user->save()){
            return $this->errorResponse(302,'添加注册信息失败');
        }

        return $this->successResponse([],'注册成功');
    }
}
