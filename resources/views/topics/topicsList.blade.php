@extends('layouts.app')

@section('styles')
    <style>
        .head_portrait{
            max-width:100px;
            max-height:100px;
            background-color: #3d4852;
        }

        .topics-list{
            border:1px #1e7e34 solid;
        }

        .sidebar{
         border:1px #1e7e34 solid;
        }
    </style>
@endSection()

@section('content')
<div class="row">
    <div class="col-lg-9 col-md-9 topics-list">
        <div class="panel">
            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">最后回复</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">最新发布</a>
                    </li>
                </ul>


            </div>

            <div class="panel-body">
                @include('topics._topics_list',['topics'=>$topics])
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 sidebar">

    </div>
</div>
@endSection()

