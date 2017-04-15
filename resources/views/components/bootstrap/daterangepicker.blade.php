@push('style')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endpush
<div class="input-group">
  {{ Form::label($name, $label) }}
  <br />
  <button class="btn btn-default btn-sm" id="daterangepicker" type="button">@lang('admin/general.Date range')</button>
  {{ Form::input('hidden', $name, Request::input($name), ['class' => 'form-control input-sm', 'id' => 'daterangepicker']) }}
</div>
@push('js')
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
$(function() {
    var date = $('input#daterangepicker').val();
    if (date != '') {
      var start = moment(date.substring(0, 10), 'DD-MM-YYYY');
      var end = moment(date.substring(12, 22), 'DD-MM-YYYY');
    } else {
      var start = moment().subtract(29, 'days');
      var end = moment();
    }
    function cb(start, end) {
        $('#daterangepicker').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('input#daterangepicker').val(start.format('DD-MM-YYYY') + 'to' + end.format('DD-MM-YYYY'));
    }
    $('#daterangepicker').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           "@lang('admin/general.Today')": [moment(), moment()],
           "@lang('admin/general.Yesterday')": [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           "@lang('admin/general.Last 7 Days')": [moment().subtract(6, 'days'), moment()],
           "@lang('admin/general.Last 30 Days')": [moment().subtract(29, 'days'), moment()],
           "@lang('admin/general.This Month')": [moment().startOf('month'), moment().endOf('month')],
           "@lang('admin/general.Last Month')": [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end);
  $('#daterangepicker').on('apply.daterangepicker', function(ev, picker) {
    this.form.submit();
  });
});
</script>
@endpush
