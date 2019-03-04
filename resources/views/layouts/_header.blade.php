
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li>

        @guest
            <li class="nav-item"><a class="nav-link" href="">登录</a></li>
            <li class="nav-item"><a class="nav-link" href="">注册</a></li>
        @else
            <li class="nav-item">{{Auth::user()->name}}</li>
            <li class="nav-item"><a class="nav-link" href="{{route('logout')}}">退出</a></li>
        @endguest
    </ul>



