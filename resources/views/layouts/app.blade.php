<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/bootstrap4/css/bootstrap.css"/>
    <style>
        .header{
            width:100%;
            background-color: rgba(0, 0, 0, .85);
            color: #999;
        }
    </style>
    @yield('styles')
</head>

<body>
<div class="app">
    <!--页头-->
    <div class="header ">
        <!--引入子视图-->
        @include('layouts._header')
    </div>

    <div class="container">
        @yield('content')
    </div>

    <div class="footer">
        @include('layouts._footer')
    </div>
</div>
</body>
</div>

<!--js代码位置，再最后-->
<script type="application/javascript" src="/js/jQuery331.js"></script>
<script type="application/javascript" src="/layer/layer.js"></script>
<script type="application/javascript" src="/js/dialog.js"></script>
<script type="application/javascript" src="/js/popper.js"></script>
<script type="application/javascript" src="/bootstrap4/js/bootstrap.js"></script>

</body>
@yield('cur_jscode')
