@extends('index')

@section('content')
{{ Form::open(array('method' => 'post')) }}
<ol class="breadcrumb">
  <li><a href="/">@lang('index.title')</a></li>
  <li class="active">@lang('menu.generate')</li>
</ol>
  <div class="panel panel-default">
    <div class="panel-heading">@lang('generate.generator')</div>
    <div class="panel-body">
      <div class="checkbox">
        <label>
          <input id="blum-micali_cb" name="blum-micali_cb" type="checkbox" value="blum-micali">
            @lang('generate.blum-micali')
          </label>
      </div>
      <div class="checkbox">
        <label><input id="rsa_cb" name="rsa_cb" type="checkbox" value="rsa">@lang('generate.rsa')</label>
      </div>
    </div>
  </div>
  <div id="blum-micali_pnl" class="panel panel-default" style="display: none;">
    <div class="panel-heading">@lang('generate.blum-micali')</div>
    <div class="panel-body">
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">a</div>
          <input id="first_num_bm" name="first_num_bm" type="text" class="form-control" placeholder="@lang('generate.prime_number')">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">p</div>
          <input id="second_num_bm" name="second_num_bm" type="text" class="form-control" placeholder="@lang('generate.prime_number')">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">x<sub>0</sub></div>
          <input id="seed_bm" name="seed_bm" type="text" class="form-control" placeholder="@lang('generate.seed')">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">n</div>
          <input id="max_number_bm" name="max_number_bm" type="text" class="form-control" placeholder="@lang('generate.max_number')">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">N</div>
          <input id="count_bm" name="count_bm" type="text" class="form-control" placeholder="@lang('generate.count')">
        </div>
      </div>
    </div>
  </div>
  <div id="rsa_pnl" class="panel panel-default" style="display: none;">
    <div class="panel-heading">@lang('generate.rsa')</div>
    <div class="panel-body">
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">p</div>
          <input id="first_num_rsa" name="first_num_rsa" type="text" class="form-control" placeholder="@lang('generate.prime_number')">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">q</div>
          <input id="second_num_rsa" name="second_num_rsa" type="text" class="form-control" placeholder="@lang('generate.prime_number')">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">e</div>
          <input id="coprime_num_rsa" name="coprime_num_rsa" type="text" class="form-control" placeholder="@lang('generate.coprime_number')">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">x<sub>0</sub></div>
          <input id="seed_rsa" name="seed_rsa" type="text" class="form-control" placeholder="@lang('generate.seed_rsa')">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">n</div>
          <input id="max_number_rsa" name="max_number_rsa" type="text" class="form-control" placeholder="@lang('generate.max_number')">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">N</div>
          <input id="count_rsa" name="count_rsa" type="text" class="form-control" placeholder="@lang('generate.count')">
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-body">
    <button id="submit_btn" type="submit" class="btn btn-default pull-right" disabled="disabled" onclick="return validate(this);">
      @lang('generate.generate')
    </button>
    </div>
  </div>
{{ Form::close() }}
@stop
