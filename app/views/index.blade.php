<!DOCTYPE html>
<html lang="{{{ App::getLocale() }}}">
<head>
    <title>@lang('index.title')</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/favicon.ico">
    {{ HTML::style('bootstrap/3.3.1/css/bootstrap.min.css') }}
    {{ HTML::style('bootstrap/3.3.1/css/bootstrap-theme.min.css') }}
    {{ HTML::style('css/style.min.css') }}
    {{ HTML::script('jquery/jquery-2.1.3.min.js') }}
    {{ HTML::script('bootstrap/3.3.1/js/bootstrap.min.js') }}
    {{ HTML::script('js/generate.min.js') }}
</head>
<body>
@include('menu')
<div class="container">
    @section('content')
        @include('home')
    @show
</div>
</body>
</html>
