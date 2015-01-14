@extends('index')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">@lang('index.title')</a></li>
        <li><a href="/tests">@lang('menu.tests')</a></li>
        <li class="active">@lang('menu.MC')</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">@lang('tests.results')</div>
        <div class="panel-body">
            <h3 class="text-center">@lang('tests.pi_value', array( 'pi' => '3.14159'))</h3>
            @if(ResultsController::isBlumMicali())
                <div>
                    <b>@lang('menu.blum-micali')</b>
                    <ul>
                        <?php $pi = McController::getMcResults('bm'); ?>
                        <li>@lang('tests.result'): <var>{{$pi['calculated']}}</var></li>
                        <li>@lang('tests.absolute'): <var>{{$pi['absolute']}}</var></li>
                        <li>@lang('tests.relative'): <var>{{$pi['relative']}}</var></li>
                    </ul>
                </div>
            @endif
            @if(ResultsController::isRsa())
                <div>
                    <b>@lang('menu.rsa')</b>
                    <ul>
                        <?php $pi = McController::getMcResults('rsa'); ?>
                        <li>@lang('tests.result'): <var>{{$pi['calculated']}}</var></li>
                        <li>@lang('tests.absolute'): <var>{{$pi['absolute']}}</var></li>
                        <li>@lang('tests.relative'): <var>{{$pi['relative']}}</var></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
@stop
