<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Weibo App') - Laravel 入门教程</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
@include('_header')

<div class="container">
    <div class="offset-md-1 col-md-10">
        @include('shared._message')
        @yield('content')
        @include('_footer')
    </div>
</div>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
