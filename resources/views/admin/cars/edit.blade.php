{!! Form::model($car, ['method' => 'PATCH', 'action' => ['Admin\CarController@update', $car], 'class' => 'form-horizontal']) !!}
<plate parts="{{ json_encode($car->segments()) }}"></plate>
<div class="form-group">
  {!! Form::label('card', __('admin/general.card: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('card', null, ['class' => 'form-control', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('type_of', __('admin/general.type_of: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('type_of', null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('system', __('admin/general.system: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('system', null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('brigade', __('admin/general.brigade: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('brigade', null, ['class' => 'form-control', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('color', __('admin/general.Color: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('color', null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('year', __('admin/general.year: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('year', null, ['class' => 'form-control input-year', 'maxlength' => '4', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('fuel', __('admin/general.fuel: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('fuel', null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('capacity', __('admin/general.capacity: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::number('capacity', null, ['class' => 'form-control', 'step' => '1', 'min' => '1', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('cylinder', __('admin/general.cylinder: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::number('cylinder', null, ['class' => 'form-control', 'step' => '1', 'min' => '1', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('axis', __('admin/general.axis: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::number('axis', null, ['class' => 'form-control', 'step' => '1', 'min' => '1', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('wheel', __('admin/general.wheel: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::number('wheel', null, ['class' => 'form-control', 'step' => '1', 'min' => '1', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('motor', __('admin/general.motor: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('motor', null, ['class' => 'form-control', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('chassis', __('admin/general.chassis: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('chassis', null, ['class' => 'form-control', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('vin', __('admin/general.vin: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('vin', null, ['class' => 'form-control', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('hull_insurance_expire', __('admin/general.hull_insurance_expire: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('hull_insurance_expire', null, ['class' => 'form-control input-expire-date-1', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('third_party_insurance_expire', __('admin/general.third_party_insurance_expire: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('third_party_insurance_expire', null, ['class' => 'form-control input-expire-date-2', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('technical_diagnosis_expire', __('admin/general.technical_diagnosis_expire: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('technical_diagnosis_expire', null, ['class' => 'form-control input-expire-date-3', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('technical_diagnosis_number', __('admin/general.technical_diagnosis_number: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('technical_diagnosis_number', null, ['class' => 'form-control', 'dir' => 'ltr']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('type_id', __('admin/general.Type: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::select('type_id', $driver->carTypesPluck(), null, ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" class="btn btn-primary">@lang('admin/general.Submit')</button>
  </div>
</div>
{!!  Form::close() !!}
@push('js')
  <script src="{{ mix('js/admin/cleave.js') }}"></script>
  <script type="text/javascript">
  new Cleave('.input-expire-date-1', {
      date: true,
      datePattern: ['Y', 'm', 'd']
  });
  new Cleave('.input-expire-date-2', {
      date: true,
      datePattern: ['Y', 'm', 'd']
  });
  new Cleave('.input-expire-date-3', {
      date: true,
      datePattern: ['Y', 'm', 'd']
  });
  new Cleave('.input-year', {
      date: true,
      datePattern: ['Y']
  });
  </script>
@endpush
