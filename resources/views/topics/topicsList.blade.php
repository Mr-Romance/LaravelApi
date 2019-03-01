@extends('layouts.app')

@section('styles')
    <style>
        .topics {
            height: auto;
            margin: 10px;
            border: 1px #00FF00 solid;
            font-size: 15px;
        }

        .img {
            width: 100px;
            height: 100px;
            background-color: #f66D9b;
        }
    </style>
@endSection()

@section('content')
    <div class="topics">
        <div class="layui-row">
            <div class="layui-col-md9">
                <table class="layui-table">
                    <colgroup>
                        <col width="150">
                        <col width="600">
                        <col width="150">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>头像</th>
                        <th>帖子内容</th>
                        <th>其他操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topics as $topic)
                        <tr>
                            <td><img class="img" src="{{$topic->user->head_portrait}}"></td>
                            <td>{{$topic->body}}</td>
                            <td>其他操作</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                    <legend>总页数低于页码总数</legend>
                </fieldset>
                {{$topics->links()}}
            </div>

            <div class="layui-col-md3">
                你的内容 3/12
            </div>

        </div>
    </div>

@endSection()

