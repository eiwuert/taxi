@include('components.bootstrap.flash')
{!! Form::open(['method' => 'POST', 'url' => 'fa/contacts', 'class' => 'form-horizontal']) !!}
<div class="form-group">
    <div class="col-md-6">
        {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => __('admin/general.Subject (*) : ')]) !!}
    </div>
    <div class="col-md-6">
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('admin/general.Email (*) : '), 'dir' => 'ltr']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        {!! Form::textarea('text', null, ['class' => 'form-control', 'placeholder' => __('admin/general.Text (*) : ')]) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-8">
        {!! captcha_img() !!}
        <button type="submit" class="btn btn-primary">@lang('admin/general.Submit')</button>
    </div>
    <div class="col-md-4">
        {!! Form::text('captcha', null, ['class' => 'form-control', 'placeholder' => __('admin/general.Captcha (*) : '), 'dir' => 'ltr']) !!}
    </div>
</div>
{!! Form::close() !!}