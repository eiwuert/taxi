<div class="box box-solid">
  <div class="box-header with-border">
    <i class="fa fa-bar-chart-o"></i>
    <h3 class="box-title">{{ $title or __('admin/general.Line Chart') }}</h3>
  </div>
  <div class="box-body">
    <div id="line-chart" style="height: 300px; padding: 0px; position: relative;"></div>
  </div>
  <!-- /.box-body-->
</div>
@push('js')
<script src="{{ elixir('js/admin/flot.js') }}"></script>
<script type="text/javascript">

$(function () {
var line_data2 = {
  data: {!! $dailyFinishedTripsOnMonth !!},
  color: "#00c0ef"
};
$.plot("#line-chart", [line_data2], {
  grid: {
    hoverable: true,
    borderColor: "#f3f3f3",
    borderWidth: 1,
    tickColor: "#f3f3f3"
  },
  series: {
    shadowSize: 0,
    lines: {
      show: true
    },
    points: {
      show: true
    }
  },
  lines: {
    fill: false,
    color: ["#3c8dbc", "#f56954"]
  },
  yaxis: {
    show: true,
  },
  xaxis: {
    show: true
  }
});
$('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
  position: "absolute",
  display: "none",
  opacity: 0.8
}).appendTo("body");
$("#line-chart").bind("plothover", function (event, pos, item) {
  if (item) {
    var x = item.datapoint[0];
    if (x == 1) {
      x = "@lang('admin/general.1st')";
    } else if (x == 2) {
      x = "@lang('admin/general.2nd')";
    } else if (x == 3) {
      x = "@lang('admin/general.3rd')";
    } else {
      x = x + "@lang('admin/general.th')";
    }
    y = item.datapoint[1];
    $("#line-chart-tooltip").html(x + " = " + y)
      .css({top: item.pageY + 5, left: item.pageX + 5})
      .fadeIn(200);
  } else {
    $("#line-chart-tooltip").hide();
  }
});

});
function labelFormatter(label, series) {
  return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
    + label
    + "<br>"
    + Math.round(series.percent) + "%</div>";
}
</script>
@endpush