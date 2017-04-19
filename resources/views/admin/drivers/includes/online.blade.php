<div id="switchState">
    {!! Form::open(['action' => ['Admin\DriverController@online', $driver], 'method' => 'POST']) !!}
    <button class="btn btn-default btn-block btn-sm"><i class="fa fa-circle text-green"></i> @lang('admin/general.Online, Go offline')</button>
    {!! Form::close() !!}
</div>

@push('js')
<script>
const switchState = new Vue({
    el: '#admin',
});
</script>
@endpush
