@extends('layouts.app')

@section('styles')
    <style>

        .img {
            height: 200px;
            width: 200px;
            background: #1E9FFF;
            margin: 0 auto;
        }

    </style>
@endSection()

@section('content')
    <form class="layui-form" id="user_edit_form">
        {{ csrf_field() }}
        <div class="layui-form-item">
            <div class="img">
                <img class="head_portrait" src="{{$user->head_portrait}}">
            </div>

            <input type="file" class="layui-btn" name="head_portrait" id="head_portrait">
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-inline">
                <input type="text" name="name" required lay-verify="required" placeholder="请输入用户名" autocomplete="off"
                       class="layui-input" value="{{$user->name}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-inline">
                <input type="text" name="phone" value="{{$user->phone}}" required lay-verify="required"
                       placeholder="请输入手机号" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-inline">
                <input type="text" name="email" value="{{$user->email}}" required lay-verify="required"
                       placeholder="请输入邮箱" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" id="edit_user">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@endSection()

@section('cur_jscode')
    <script>
        $('#edit_user').click(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var user_edit_form = document.querySelector('#user_edit_form');
            var formData = new FormData(user_edit_form);
            formData.append("head_portrait", $('#head_portrait').get(0).files[0]);

            $.ajax({
                url: '/users/edit',
                processData: false,  // 这个必须为false，不转换的信息
                contentType: false, // 这个必须为false，不指定发送信息的编码类型
                data: formData,
                type: "POST",
                success: function (data) {
                    if (100 == data.code) {
                        dialog.successTo(data.msg,'/users/show/'+data.data.user_id);
                    } else {
                        dialog.showError(data.msg);
                    }
                }
            });
            return false;
        });
    </script>
@endsection()
