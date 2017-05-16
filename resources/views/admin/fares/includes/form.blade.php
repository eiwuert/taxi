<div class="form-group">
    {!! Form::label('zone_id', __('admin/general.Zone: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('zone_id', $zones,null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('currency_id', __('admin/general.Currency: '), ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('currency_id', $currencies, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="box-group" id="accordion">
@foreach($types as $type)
    <div class="panel box">
        <div class="box-header with-border">
            <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#{{ $type->name }}" aria-expanded="false" class="collapsed">
                {{ $type->name }}
            </a>
            </h4>
        </div>
        <div id="{{ $type->name }}" class="panel-collapse collapse" aria-expanded="false" style="height: 0">
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('cost[' . $type->name . '][entry]', __('admin/general.entry'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::number('cost[' . $type->name . '][entry]', null, ['class' => 'form-control', 'dir' => 'ltr', 'min' => '0', 'step' => '1']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('cost[' . $type->name . '][discount]', __('admin/general.discount'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::number('cost[' . $type->name . '][discount]', null, ['class' => 'form-control', 'dir' => 'ltr', 'max' => '100', 'min' => '0', 'step' => '1']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('cost[' . $type->name . '][min]', __('admin/general.min'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::number('cost[' . $type->name . '][min]', null, ['class' => 'form-control', 'dir' => 'ltr', 'min' => '0', 'step' => '1']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('cost[' . $type->name . '][surcharge]', __('admin/general.surcharge'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                        {!! Form::time('cost[' . $type->name . '][surcharge][from]', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::time('cost[' . $type->name . '][surcharge][to]', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::number('cost[' . $type->name . '][surcharge][amount]', null, ['class' => 'form-control', 'min' => '0', 'step' => '1', 'dir' => 'ltr', 'placeholder' => __('admin/general.amount')]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('cost[' . $type->name . '][per_distance]', __('admin/general.per distance'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::number('cost[' . $type->name . '][per_distance]', null, ['class' => 'form-control', 'dir' => 'ltr', 'min' => '0', 'step' => '1']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('cost[' . $type->name . '][per_time]', __('admin/general.per time'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::number('cost[' . $type->name . '][per_time]', null, ['class' => 'form-control', 'dir' => 'ltr', 'min' => '0', 'step' => '1']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('cost[' . $type->name . '][time_unit]', __('admin/general.time unit'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('cost[' . $type->name . '][distance_unit]', ['minute' => __('admin/general.minute'), 'hour' => __('admin/general.hour')],null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('cost[' . $type->name . '][distance_unit]', __('admin/general.distance unit'), ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('cost[' . $type->name . '][time_unit]', ['kilometer' => __('admin/general.kilometer'), 'mile' => __('admin/general.mile')],null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
<hr>
<div class="form-group">
    <div class="col-sm-12">
        <button type="submit" class="btn btn-primary">@lang('admin/general.Submit')</button>
    </div>
</div>