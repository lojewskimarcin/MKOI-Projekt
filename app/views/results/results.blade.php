@extends('index')

@section('content')
    @if(ResultsController::isBlumMicali() && ResultsController::isRsa())
        <ol class="breadcrumb">
            <li><a href="/">@lang('index.title')</a></li>
            @if($resultsItem == ResultsItems::ALL)
                <li class="active">@lang('menu.results')</li>
            @elseif($resultsItem == ResultsItems::BLUM_MICALI)
                <li><a href="/results">@lang('menu.results')</a></li>
                <li class="active">@lang('menu.blum-micali')</li>
            @elseif($resultsItem == ResultsItems::RSA)
                <li><a href="/results">@lang('menu.results')</a></li>
                <li class="active">@lang('menu.rsa')</li>
            @endif
        </ol>
    @elseif(ResultsController::isBlumMicali())
        <ol class="breadcrumb">
            <li><a href="/">@lang('index.title')</a></li>
            <li class="active">@lang('menu.results')</li>
        </ol>
    @elseif(ResultsController::isRsa())
        <ol class="breadcrumb">
            <li><a href="/">@lang('index.title')</a></li>
            <li class="active">@lang('menu.results')</li>
        </ol>
    @endif

    @if($resultsItem == ResultsItems::ALL)
        @include('results.all')
    @elseif($resultsItem == ResultsItems::BLUM_MICALI)
        @include('results.base', array('results' => ResultsController::getBlumMicaliResults(),
        'max' => ResultsController::getMaxBlumMicali()))
    @elseif($resultsItem == ResultsItems::RSA)
        @include('results.base', array('results' => ResultsController::getRsaResults(),
        'max' => ResultsController::getMaxRsa()))
    @endif

@stop
