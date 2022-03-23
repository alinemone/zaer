<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap-theme.css')}}">
    <!-- Bootstrap rtl -->
    <link rel="stylesheet" href="{{asset('dist/css/rtl.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.css')}}">

    <link rel="stylesheet" href="{{asset('dist/css/skins/skin-blue.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

    <script src="{{ asset('js/admin.js') }}"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
@include('sweet::alert')
<div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">پنل</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>کنترل پنل مدیریت</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <div class="pull-right"style=" padding-top: 10px; ">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                       class="btn btn-danger">خروج</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <!-- right side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-right image">
                </div>
                <div class="pull-right info">
                    <p>{{auth()->user()->name}}</p>
                </div>
            </div>
            <ul class="sidebar-menu" data-widget="tree">
                @role('admin|reception')
                <li class="header">اقامتگاه</li>
                <li class="active">
                    <a href="{{route('admin.place.list')}}"><i class="fa fa-home"></i>
                        <span>مدیریت اقامتگاه ها</span></a>
                </li>
                @endrole
                @role('admin|reception')
                    <li class="header">پذیریش</li>
                    <li class="active">
                        <a href="{{route('admin.reception.list')}}"><i class="fa fa-user"></i>
                            <span> لیست پذیرش شده ها</span></a>
                    </li>
                    <li class="active">
                        <a href="{{route('admin.reception.create',['male','type'=>1])}}"><i class="fa fa-user"></i>
                            <span>پذیرش برادران</span></a>
                    </li>
                    <li class="active">
                        <a href="{{route('admin.reception.create',['female','type'=>1])}}"><i class="fa fa-user"></i>
                            <span>پذیرش خواهران</span></a>
                    </li>
                @endrole
                @role('admin|reception')
                <li class="header">کاروان</li>
                <li class="active">
                    <a href="{{ route('admin.group.index') }}"><i class="fa fa-user"></i>
                        <span>مدیریت کاروان</span></a>
                </li>
                <li class="active">
                    <a href="{{ route('admin.group.reception','male') }}"><i class="fa fa-user"></i>
                        <span>رزور کاروان برادران</span></a>
                </li>
                <li class="active">
                    <a href="{{ route('admin.group.reception','female') }}"><i class="fa fa-user"></i>
                        <span>رزور کاروان خواهران</span></a>
                </li>


                <li class="header">خدام</li>
                <li class="active">
                    <a href="{{ route('admin.servant.list') }}"><i class="fa fa-user"></i>
                        <span>مدیریت خدام</span></a>
                </li>
                <li class="active">
                    <a href="{{route('admin.reception.create',['male','type'=>2])}}"><i class="fa fa-user"></i>
                        <span>پذیرش خادم برادران</span></a>
                </li>
                <li class="active">
                    <a href="{{route('admin.reception.create',['female','type'=>2])}}"><i class="fa fa-user"></i>
                        <span>پذیرش خادم خواهران</span></a>
                </li>
                @endrole
                @role('admin')
                <li class="header">گزارش گیری</li>
                <li class="active">
                    <a href="{{route('admin.report')}}"><i class="fa fa-bar-chart"></i>
                        <span>گزارش گیری</span></a>
                </li>
                @endrole
                @role('admin')
                <li class="header">تنظیمات</li>
                <li class="active">
                    <a href="{{route('admin.setting.index')}}"><i class="fa fa-cog"></i>
                        <span>تنظیمات</span></a>
                    <a href="{{route('admin.role.index')}}"><i class="fa fa-cog"></i>
                        <span>دسترسی ها</span></a>
                </li>
                @endrole

            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{$slot}}
    </div>
    <!-- /.content-wrapper -->


</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{ asset('js/custom.js') }}"></script>

@yield('scripts')
</body>
</html>
