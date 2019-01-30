@extends('layouts.app')
@section('styles')
    <style>
        .left {
            float: left;
        }

        .left img {
            height: 300px;
            width: 300px;
        }

        .head_protrait {
            height: 300px;
            width: 300px;
        }

        .right {
            float: right;
        }
    </style>
@endSection()
@section('content')
    <div class="user_info">
        <div class="left">
            <div class="img">
                <img class="head_protrait" src="{{$user->head_portrait}}">
            </div>
            <hr class="layui-bg-cyan">
            <div class="user_info">
                <div>
                    <label class="layui-form-label">用户名</label>
                    <label>{{$user->name}}</label>
                </div>
                <div>
                    <label class="layui-form-label">手机号</label>
                    <label>{{$user->phone}}</label>
                </div>
                <div>
                    <label class="layui-form-label">邮箱</label>
                    <label>{{$user->email}}</label>
                </div>
                <div>
                    <label class="layui-form-label">注册时间</label>
                    <label>{{$user->create_time}}</label>
                </div>
                <div>
                    <a class="layui-nav-item" href="">修改个人信息</a>
                </div>
            </div>

            <div class="right">

            </div>
        </div>
@endSection()
