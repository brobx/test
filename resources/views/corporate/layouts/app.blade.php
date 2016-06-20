<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Corporate Panel | Qarenhom</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/assets/css/backend.css">
    <style>
        .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
            background-color: #fff;
        }
        .skin-blue .sidebar-menu>li.header {
            background: #eee;
            color: #333;
        }
        .skin-blue .sidebar a {
            color: #000;
        }
        .skin-blue .sidebar-menu>li {
            transition: all 0.3s ease-in-out;
        }
        .skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
            color: #000;
            background: #fff;
            border-left-color: #23aae1;
        }
        .skin-blue .sidebar-menu>li>.treeview-menu {
            background: #eee;
        }
        .skin-blue .treeview-menu>li>a {
            color: #333;
        }
        .skin-blue .treeview-menu>li.active>a, .skin-blue .treeview-menu>li>a:hover {
            color: #000;
        }
        .user-panel>.info {
            position: relative;
            left: auto;
            padding: 10px;
            color: #333;
        }
        .skin-blue .user-panel>.info, .skin-blue .user-panel>.info>a {
            color: #333;
        }
    </style>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    @include('corporate.layouts.header')
    @include('corporate.layouts.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @yield('page.title', '')
                <small>@yield('page.description', '')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                @yield('page.breadcrumb', '')
            </ol>
        </section>

        <section class="content">
            @unless(isset($suppressAlerts) && $suppressAlerts)
                @include('corporate.layouts.alerts')
            @endunless

            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <!-- <b>Version</b> 2.3.2 -->
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="/">Quarenhom</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- ./wrapper -->

@if(config('app.env') == 'production')
    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
        window.$zopim || (function (d, s) {
            var z = $zopim = function (c) {
                z._.push(c)
            }, $ = z.s =
                    d.createElement(s), e = d.getElementsByTagName(s)[0];
            z.set = function (o) {
                z.set._.push(o)
            };
            z._ = [];
            z.set._ = [];
            $.async = !0;
            $.setAttribute('charset', 'utf-8');
            $.src = '//v2.zopim.com/?3gNJnv6aszkivnOvIXtpvOXJIPEJ9mxE';
            z.t = +new Date;
            $.type = 'text/javascript';
            e.parentNode.insertBefore($, e)
        })(document, 'script');
    </script>
    <!--End of Zopim Live Chat Script-->
@endif
<script src="/assets/js/backend.js"></script>
@yield('scripts')
</body>
</html>
