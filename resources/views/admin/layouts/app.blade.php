<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    @include('admin.layouts.includes.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('admin.layouts.includes.header')
    @include('admin.layouts.includes.sidebar')
    @section('main-content')
    @show
    @include('admin.layouts.includes.footer')
    
</div>
</body>
</html>