<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand text-uppercase" href="/">@lang('menu.home')</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li{{ $menuItem === MenuItems::GENERATE ? ' class="active"' : '' }}>
                    <a href="/generate">@lang('menu.generate')</a>
                </li>
                @if(ResultsController::areAvailable())
                    @if(ResultsController::isBlumMicali() && ResultsController::isRsa())
                        <li class="dropdown{{ $menuItem === MenuItems::RESULTS ? ' active' : '' }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">@lang('menu.results')<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/results/blummicali">@lang('menu.blum-micali')</a></li>
                                <li><a href="/results/rsa">@lang('menu.rsa')</a></li>
                                <li class="divider"></li>
                                <li><a href="/results">@lang('menu.all_results')</a></li>
                            </ul>
                        </li>
                    @elseif(ResultsController::isBlumMicali())
                        <li{{ $menuItem === MenuItems::RESULTS ? ' class="active"' : '' }}>
                            <a href="/results/blummicali">@lang('menu.results')</a>
                        </li>
                    @elseif(ResultsController::isRsa())
                        <li{{ $menuItem === MenuItems::RESULTS ? ' class="active"' : '' }}>
                            <a href="/results/rsa">@lang('menu.results')</a>
                        </li>
                    @endif
                @endif
            </ul>
            <p class="navbar-text navbar-right text-uppercase visible-md-inline visible-lg-inline">@lang('menu.right_info')</p>
        </div>
    </div>
</nav>
