{!! Form::model($driver, ['method' => 'PATCH', 'action' => ['Admin\DriverController@update', $driver->id], 'class' => 'form-horizontal', 'files' => true]) !!}
<input type="hidden" name="driver_id" value="{{$driver->id}}">

<div class="form-group">
    {!! Form::label('phone', __('admin/general.Phone: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('phone', $driver->user->phone, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
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
        {!! Form::select('gender', ['male' => __('admin/general.male'), 'female' => __('admin/general.female'), 'not specified'=> __('admin/general.not specified')],
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
        {!! Form::select('state', \Auth::user()->states(), null, ['class' => 'form-control']) !!}
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
    {!! Form::label('identity_number', __('admin/general.Identity number: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('identity_number', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('identity_code', __('admin/general.Identity code: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('identity_code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('credit_card', __('admin/general.Credit card: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('credit_card', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('abuse_history', __('admin/general.Abuse history: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('abuse_history', [true => __('admin/general.true'), false => __('admin/general.false')], ['class' => 'form-control']) !!}
    </div>
</div>
@if (is_null($driver->user->meta))
<div class="form-group">
    {!! Form::label('documents', __('admin/general.Documents: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div class="btn btn-sm btn-default btn-file">
            <i class="fa fa-paperclip"></i> @lang('admin/general.Upload zip file')
            {!! Form::file('documents', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
@else
<div class="form-group">
    {!! Form::label('documents', __('admin/general.Documents: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        @include('admin.drivers.includes.document', ['driver' => $driver])
    </div>
</div>
@endif
@if (str_contains($driver->picture, 'img/no-profile.png'))
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
        @include('admin.drivers.includes.picture', ['driver' => $driver])
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
                                {!! Form::select('device_type', ['android' => 'Android', 'ios' => 'iOS', 'web' => 'Web'], null, ['class' => 'form-control']) !!}
                            </div>
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
</div>
{!! Form::close() !!}
