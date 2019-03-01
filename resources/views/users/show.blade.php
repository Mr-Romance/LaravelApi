@extends('layouts.app')
@section('styles')
    <style>

        .img {
            height: 200px;
            width: 200px;
            background: #1E9FFF;
            margin: 0 auto;
        }
        .head_portrait{
            width:200px;
            height:200px;
        }

    </style>
@endSection()
@section('content')
    <div class="layui-row">
        <div class="layui-col-md3">
            <div class="layui-form-item">
                <div class="img">
                <img class="head_portrait" src="{{$user->head_portrait}}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">用户名</label>
                <label class="layui-colla-title">{{$user->name}}</label>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">手机号</label>
                <label class="layui-colla-title">{{$user->phone}}</label>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <label class="layui-colla-title">{{$user->email}}</label>
            </div>

            <div class="layui-form-item">
                <a href="/users/edit/{{$user->id}}" class="layui-btn" id="editUser">修改</a>
            </div>
        </div>
    </div>
@endSection()
