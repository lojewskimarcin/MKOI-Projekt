@extends('index')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">@lang('index.title')</a></li>
        <li><a href="/tests">@lang('menu.tests')</a></li>
        <li class="active">@lang('menu.runs_test')</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">@lang('tests.results')</div>
        <div class="panel-body">
            @if(ResultsController::isBlumMicali())
                <div>
                    <b>@lang('menu.blum-micali')</b>
                    <ul>
                        <?php $runs = RunsTestController::getRunsTestResults('bm'); ?>
                        <li>@lang('tests.ups'): <var>{{$runs['ups']}}</var></li>
                        <li>@lang('tests.downs'): <var>{{$runs['downs']}}</var></li>
                    </ul>
                </div>
            @endif
            @if(ResultsController::isRsa())
                <div>
                    <b>@lang('menu.rsa')</b>
                    <ul>
                        <?php $runs = RunsTestController::getRunsTestResults('rsa'); ?>
                        <li>@lang('tests.ups'): <var>{{$runs['ups']}}</var></li>
                        <li>@lang('tests.downs'): <var>{{$runs['downs']}}</var></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
@stop
