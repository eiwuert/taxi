{!! Form::model($driver, ['method' => 'PATCH', 'action' => ['Admin\DriverController@update', $driver->id], 'class' => 'form-horizontal', 'files' => true]) !!}
<div class="form-group">
    {!! Form::label('phone', 'Phone: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('phone', $driver->PhoneNumber(), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('first_name', 'First name: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('last_name', 'Last name: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('email', 'Email: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('gender', 'Gender: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('gender', ['male' => 'male', 'female' => 'female', 'not specified'=>'not specified'],
        null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('address', 'Address: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('state', 'State: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('state', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('country', 'Country: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('country', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('zipcode', 'Zip code: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
    </div>
</div>
@if (is_null($driver->user->meta))
<div class="form-group">
    {!! Form::label('documents', 'Documents: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div class="btn btn-sm btn-default btn-file">
            <i class="fa fa-paperclip"></i> Choose Zip File
            {!! Form::file('documents', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
@else
<div class="form-group">
    {!! Form::label('documents', 'Documents: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        @include('admin.drivers.includes.document', ['driver' => $driver])
    </div>
</div>
@endif
@if ($driver->picture == 'no-profile.png')
<div class="form-group">
    {!! Form::label('picture', 'Picture: ', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div class="btn btn-sm btn-default btn-file">
            <i class="fa fa-picture-o"></i> Choose picture
            {!! Form::file('picture', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
@else
<div class="form-group">
    {!! Form::label('picture', 'Picture: ', ['class' => 'col-sm-2 control-label']) !!}
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
                More <i class="fa fa-angle-down"></i>
            </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('lang', 'Lang: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('lang', ['fa' => 'Farsi', 'en' => 'English', 'ku' => 'Kurdi'], null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('device_token', 'Device token: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('device_token', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('device_type', 'Device type: ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('device_type', ['android' => 'Android', 'ios' => 'iOS', 'web' => 'Web'], null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}