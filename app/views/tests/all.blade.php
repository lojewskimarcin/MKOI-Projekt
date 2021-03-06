@extends('index')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">@lang('index.title')</a></li>
        <li class="active">@lang('menu.tests')</li>
    </ol>

    <div class="panel panel-default">
        <div class="panel-heading">@lang('tests.all')</div>
        <div class="panel-body">
            <ul>
                <li><a href="/tests/chisquare">@lang('menu.chi-square')</a></li>
                <li><a href="/tests/mc">@lang('menu.MC')</a></li>
                <li><a href="/tests/runstest">@lang('menu.runs_test')</a></li>
                <li><a href="/tests/statistics">@lang('menu.statistics')</a></li>
            </ul>
        </div>
    </div>
@stop
