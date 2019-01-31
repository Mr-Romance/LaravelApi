@extends('layouts.app')

@section('content')
    <form class="layui-form" id="loginForm">
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-inline">
                <input type="text" name="phone" required lay-verify="required" placeholder="请输入手机号" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-inline">
                <input type="password" name="password" required lay-verify="required" placeholder="请输入密码"
                       autocomplete="off"
                       class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" id="login">登录</button>
            </div>
        </div>
    </form>
@endSection()

@section('cur_jscode')
    <script>
        $('#login').click(function () {
            var post_data = $('#loginForm').serializeArray();
            $.post(
                '/login',
                post_data,
                function (data) {
                    if (100 == data.code) {
                        dialog.successAuto(data.msg, '/users/show/' + data.data.user_id);
                    } else {
                        dialog.showError(data.msg);
                    }
                }
            );
            return false;
        });
    </script>
@endSection()