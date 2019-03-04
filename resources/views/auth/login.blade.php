@extends('layouts.app')

@section('styles')
    <style>
    </style>
@endSection()

@section('content')

    <form id="loginForm">
        {{csrf_field()}}
        <div class="form-row">
        <div class="form-group col-md-3" >
            <label for="exampleInputEmail1">手机号</label>
            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="emailHelp" placeholder="Enter phone">
        </div>
        </div>

        <div class="form-row">
        <div class="form-group col-md-3">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        </div>
        <button type="button" class="btn btn-primary" id="login">Submit</button>
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