{!! Form::model($driver, ['method' => 'PATCH', 'action' => ['Admin\DriverController@update', $driver->id], 'class' => 'form-horizontal', 'files' => true]) !!}
<input type="hidden" name="driver_id" value="{{$driver->id}}">
<div class="form-group">
    {!! Form::label('phone', __('admin/general.Phone: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('phone', $driver->user->phone, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>
</div>
<div class="form-group" :class="{'has-error': errors.has('first_name') }" >
  <label class="col-sm-2 control-label" for="first_name">@lang('admin/general.First name: ')</label>
  <div class="col-sm-10">
    <input v-validate.initial="'required|max:255'" class="form-control" name="first_name" value="{{ old('first_name') ?? $driver->first_name }}" dir="auto">
    <p class="text-danger" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</p>
  </div>
</div>
<div class="form-group" :class="{'has-error': errors.has('last_name') }" >
  <label class="col-sm-2 control-label" for="last_name">@lang('admin/general.Last name: ')</label>
  <div class="col-sm-10">
    <input v-validate.initial="'required|max:255'" class="form-control" name="last_name" value="{{ old('last_name') ?? $driver->last_name }}" dir="auto">
    <p class="text-danger" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</p>
  </div>
</div>
<div class="form-group" :class="{'has-error': errors.has('email') }" >
  <label class="col-sm-2 control-label" for="email">@lang('admin/general.Email: ')</label>
  <div class="col-sm-10">
    <input v-validate.initial="'required|max:255|email'" class="form-control" name="email" value="{{ old('email') ?? $driver->email }}" dir="ltr">
    <p class="text-danger" v-if="errors.has('email')">@{{ errors.first('email') }}</p>
  </div>
</div>
<div class="form-group">
    {!! Form::label('gender', __('admin/general.Gender: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('gender', ['male' => __('admin/general.male'), 'female' => __('admin/general.female'), 'not specified'=> __('admin/general.not specified')],
        null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group" :class="{'has-error': errors.has('address') }" >
  <label class="col-sm-2 control-label" for="address">@lang('admin/general.Address: ')</label>
  <div class="col-sm-10">
    <input v-validate.initial="'required|max:255'" class="form-control" name="address" value="{{ old('address') ?? $driver->address }}" dir="ltr">
    <p class="text-danger" v-if="errors.has('address')">@{{ errors.first('address') }}</p>
  </div>
</div>
<div class="form-group">
    {!! Form::label('state', __('admin/general.State: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <select name="state" class="form-control">
          <option disabled value="">@lang('admin/general.Please select one')</option>
          @foreach (\Auth::user()->states() as $value => $name)
            <option value="{{ $value }}" @if($value == $driver->state) selected="selected" @endif>{{ $name }}</option>
          @endforeach
        </select>
    </div>
</div>
<div class="form-group" :class="{'has-error': errors.has('country') }" >
  <label class="col-sm-2 control-label" for="country">@lang('admin/general.Country: ')</label>
  <div class="col-sm-10">
    <input v-validate.initial="'required'" class="form-control" name="country" value="{{ old('country') ?? $driver->country }}" dir="auto">
    <p class="text-danger" v-if="errors.has('country')">@{{ errors.first('country') }}</p>
  </div>
</div>
<div class="form-group" :class="{'has-error': errors.has('zipcode') }" >
  <label class="col-sm-2 control-label" for="zipcode">@lang('admin/general.Zip code: ')</label>
  <div class="col-sm-10">
    <input maxlength="10" v-validate.initial="'required|digits:10'" class="form-control" name="zipcode" value="{{ old('zipcode') ?? $driver->zipcode }}" dir="ltr">
    <p class="text-danger" v-if="errors.has('zipcode')">@{{ errors.first('zipcode') }}</p>
  </div>
</div>
<div class="form-group" :class="{'has-error': errors.has('identity_number') }" >
  <label class="col-sm-2 control-label" for="identity_number">@lang('admin/general.Identity number: ')</label>
  <div class="col-sm-10">
    <input maxlength="10" v-validate.initial="'required'" class="form-control" name="identity_number" value="{{ old('identity_number') ?? $driver->identity_number }}" dir="ltr">
    <p class="text-danger" v-if="errors.has('identity_number')">@{{ errors.first('identity_number') }}</p>
  </div>
</div>
<div class="form-group" :class="{'has-error': errors.has('identity_code') }" >
  <label class="col-sm-2 control-label" for="identity_code">@lang('admin/general.Identity code: ')</label>
  <div class="col-sm-10">
    <input maxlength="10" v-validate.initial="'required|digits:10'" class="form-control" name="identity_code" value="{{ old('identity_code') ?? $driver->identity_code }}" dir="ltr">
    <p class="text-danger" v-if="errors.has('identity_code')">@{{ errors.first('identity_code') }}</p>
  </div>
</div>
<div class="form-group" :class="{'has-error': errors.has('credit_card') }" >
  <label class="col-sm-2 control-label" for="credit_card">@lang('admin/general.Credit card: ')</label>
  <div class="col-sm-10">
    <input maxlength="16" v-validate.initial="'required|digits:16'" class="form-control" name="credit_card" value="{{ old('credit_card') ?? $driver->credit_card }}" dir="ltr">
    <p class="text-danger" v-if="errors.has('credit_card')">@{{ errors.first('credit_card') }}</p>
  </div>
</div>
<div class="form-group">
    {!! Form::label('abuse_history', __('admin/general.Abuse history: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('abuse_history', [true => __('admin/general.abuse_history_true'), false => __('admin/general.abuse_history_false')], [$driver->abuse_history], ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('drug_abuse', __('admin/general.Drug abuse: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('drug_abuse', [true => __('admin/general.drug_abuse_true'), false => __('admin/general.drug_abuse_false')], [$driver->drug_abuse], ['class' => 'form-control']) !!}
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
        <span class="help-block"></span>
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
        <span class="help-block"></span>
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
          <button type="submit" class="btn btn-primary" v-if="errors.any()" disabled="disabled">@lang('admin/general.Submit')</button>
          <button type="submit" class="btn btn-primary" v-else>@lang('admin/general.Submit')</button>
        </div>
    </div>
</div>
{!! Form::close() !!}
@push('js')
<script type="text/javascript">
$(function() {
  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });
  $(document).ready( function() {
    $(':file').on('fileselect', function(event, numFiles, label) {
      var input = $(this).parents('.form-group').find(':text'),
        log = numFiles > 1 ? numFiles + ' files selected' : label;

      if( input.length ) {
        input.val(log);
      } else {
        if( log ) $(this).parents('.form-group').find('.help-block').text(label);
      }
    });
  });
});
</script>
@endpush
