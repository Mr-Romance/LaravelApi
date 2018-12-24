
<ul class="layui-nav" lay-filter="">
    @guest
        <li class="layui-nav-item"><a href="">登录</a></li>
        <li class="layui-nav-item"><a href="">注册</a></li>
    @else
    <li class="layui-nav-item">{{Auth::user()->name}}</li>
    <li class="layui-nav-item"><a href="{{route('logout')}}">退出</a></li>
    @endguest

</ul>



