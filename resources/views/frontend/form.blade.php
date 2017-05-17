@include('components.bootstrap.flash')
{!! Form::open(['method' => 'POST', 'url' => 'fa/contacts', 'class' => 'form-horizontal']) !!}
<div class="form-group">
    {!! Form::label('subject', __('admin/general.Subject (*) : '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('email', __('admin/general.Email (*) : '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('text', __('admin/general.Text (*) : '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('captcha', __('admin/general.Captcha (*) : '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! captcha_img() !!}
        {!! Form::text('captcha', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">@lang('admin/general.Submit')</button>
    </div>
</div>
{!! Form::close() !!}