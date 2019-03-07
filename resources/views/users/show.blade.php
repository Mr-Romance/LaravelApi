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
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{$user->head_portrait}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$user->phone}}</li>
                    <li class="list-group-item">{{$user->email}}</li>
                </ul>
            </div>
        </div>

        <div class="col-md-9 col-lg-9">
            @include('topics._topics_list',['topics'=>$topics])
        </div>
    </div>
@endSection()
