<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class UsersController extends Controller
{
    /**
     *  显示用户信息页
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user){
        // 用到概念：路由模型绑定
        return view('users.show',compact('user'));
    }

    public function upd_users_table(){
        Schema::table('users', function (Blueprint $table) {
            $table->string('remember_token')->nullable();
        });
    }
}
