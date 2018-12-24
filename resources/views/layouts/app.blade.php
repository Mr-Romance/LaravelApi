<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="/layui/css/layui.css"/>
    @yield('styles')
</head>

<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <!--页头-->
    <div class="layui-header">
        <!--引入子视图-->
        @include('layouts._header')
    </div>

    <div class="layui-container">
        @yield('content')
    </div>

    <div class="layui-footer">
        @include('layouts._footer')
    </div>
</div>

</body>

<!--js代码位置，再最后-->
<script type="application/javascript" src="/js/jQuery331.js"></script>
<script type="application/javascript" src="/layui/layer/layer.js"></script>
<script type="application/javascript" src="/js/dialog.js"></script>
@yield('cur_jscode')
