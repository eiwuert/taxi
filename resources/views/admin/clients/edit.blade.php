{!! Form::model($client, ['method' => 'PATCH', 'action' => ['Admin\ClientController@update', $client->id], 'class' => 'form-horizontal', 'files' => true]) !!}
<input type="hidden" name="client_id" value="{{$client->id}}">
<div class="form-group">
  {!! Form::label('phone', __('admin/general.Phone: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('phone', $client->user->phone(), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('first_name', __('admin/general.First name: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('last_name', __('admin/general.Last name: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('email', __('admin/general.Email: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('email', null, ['class' => 'form-control', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('gender', __('admin/general.Gender: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::select('gender', ['male' => __('admin/general.male'), 'female' => __('admin/general.female'), 'not specified' => __('admin/general.not specified')],
    null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('address', __('admin/general.Address: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('state', __('admin/general.State: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::select('state', \Auth::user()->states(), $client->state, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('country', __('admin/general.Country: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('country', null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('zipcode', __('admin/general.Zip code: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('balance', __('admin/general.Balance: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::number('balance', null, ['class' => 'form-control', 'step' => '10']) !!}
  </div>
</div>
@if (str_contains($client->picture, 'no-profile.png'))
<div class="form-group">
  {!! Form::label('picture', __('admin/general.Picture: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    <div class="btn btn-sm btn-default btn-file">
      <i class="fa fa-picture-o"></i> @lang('admin/general.Choose picture')
      {!! Form::file('picture', null, ['class' => 'form-control']) !!}
    </div>
  </div>
</div>
@else
<div class="form-group">
  {!! Form::label('picture', __('admin/general.Picture: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    @include('admin.clients.includes.picture', ['client' => $client])
  </div>
</div>
@endif
<div class="box-group" id="accordion">
  <div class="panel box box-primary">
    <div class="box-header">
      <h4 class="box-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="">
        @lang('admin/general.More') <i class="fa fa-angle-down"></i>
      </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
      <div class="box-body">
        <div class="form-group">
          {!! Form::label('lang', __('admin/general.Lang: '), ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            {!! Form::select('lang', ['fa' => 'Farsi', 'en' => 'English', 'ku' => 'Kurdi'], null, ['class' => 'form-control']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('device_token', __('admin/general.Device token: '), ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            {!! Form::text('device_token', null, ['class' => 'form-control']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('device_type', __('admin/general.Device type: '), ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-10">
            {!! Form::select('device_type', ['android' => __('admin/general.Android'), 'ios' => __('admin/general.iOS'), 'web' => __('admin/general.Web')], null, ['class' => 'form-control']) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" class="btn btn-primary">@lang('admin/general.Submit')</button>
  </div>
</div>
{!! Form::close() !!}