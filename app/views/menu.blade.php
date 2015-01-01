<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand text-uppercase" href="/">@lang('menu.home')</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li{{ $menuItem === MenuItems::GENERATE ? ' class="active"' : '' }}>
          <a href="generate">@lang('menu.generate')</a>
        </li>
      </ul>
      <p class="navbar-text navbar-right text-uppercase">@lang('menu.right_info')</p>
    </div>
  </div>
</nav>
