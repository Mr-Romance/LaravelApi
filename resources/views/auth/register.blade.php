@extends('layouts.app')

@section('content')
    <form class="layui-form" id="registerForm">
        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
                <input type="text" name="name" required lay-verify="required" placeholder="请输入用户名" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-inline">
                <input type="text" name="phone" required lay-verify="required" placeholder="请输入手机号" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-inline">
                <input type="text" name="email" required lay-verify="required" placeholder="请输入邮箱" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">秘密</label>
            <div class="layui-input-inline">
                <input type="text" name="password" required lay-verify="required" placeholder="请输入邮箱" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">确认秘密</label>
            <div class="layui-input-inline">
                <input type="text" name="password_confirmation" required lay-verify="required" placeholder="请输入邮箱"
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" id="register">注册</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@endsection

@section('cur_jscode')
    <script>
        $('#register').click(function () {
            var data = $('#registerForm').serializeArray();

            $.post(
                'register',
                data,
                function (data) {
                    if (100 != data.code) {
                        dialog.showError(data.msg);
                    } else {
                        dialog.successTo(data.msg, '/');
                    }
                }
            );
        });
    </script>
@endsection
