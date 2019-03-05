@php
    $categories=\App\Models\Category::getAllCategories();
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="nav nav-pill mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('topics-list')}}">
                    全部话题
                </a>
            </li>
            @if(isset($categories))
                @foreach($categories as $category)
                    <li class="nav-item active">
                        <a class="nav-link" href={{route('category-topics-list',['category_id'=>$category->id])}}>
                            {{$category->name}}
                        </a>
                    </li>
                @endforeach
                @endif
        </ul>

        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar navbar-expand-lg navbar-light bg-light">
                <li class="nav-item dropdown">
                    @guest
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            登录
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">注册</a>
                        </div>
                        @else
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">编辑</a>
                            <a class="dropdown-item" href="#">退出</a>
                        </div>
                       @endguest
                </li>
            </ul>
        </form>
    </div>
</nav>

