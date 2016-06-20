<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel | Qarenhom</title>
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
    @include('components.favicon')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')

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
            @include('admin.layouts.alerts')
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            Developed by <a href="http://www.kite.agency" target="_blank"></a>
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="/">Quarenhom</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- ./wrapper -->

<script src="/assets/js/backend.js"></script>
@yield('scripts')
</body>
</html>
