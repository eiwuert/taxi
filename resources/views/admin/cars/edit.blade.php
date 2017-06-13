{!! Form::model($car, ['method' => 'PATCH', 'action' => ['Admin\CarController@update', $car], 'class' => 'form-horizontal']) !!}
<plate parts="{{ json_encode($car->segments()) }}"></plate>
<div class="form-group">
  {!! Form::label('color', __('admin/general.Color: '), ['class' => 'col-sm-2 control-label']) !!}
  <div class="col-sm-10">
    {!! Form::text('color', null, ['class' => 'form-control']) !!}
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
